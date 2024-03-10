<?php

namespace App\Livewire;

use App\Models\Pref;
use App\Models\User;
use App\Models\KpiArea;
use App\Models\KpiItem;
use Livewire\Component;
use App\Models\KpiScore;
use Illuminate\Support\Collection;
use Livewire\Attributes\Url;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class KpiSubmission extends Component
{
    #[Url]
    public $area_id;
    public $areas;

    #[Url]
    public $f_year;
    public $years;

    #[Url]
    public $month;
    public $months;
    public $month_name;

    #[Url]
    public $status;

    public function mount()
    {
        $this->months = [
            1 => __('Januari'),
            2 => __('Februari'),
            3 => __('Maret'),
            4 => __('April'),
            5 => __('Mei'),
            6 => __('Juni'),
            7 => __('Juli'),
            8 => __('Agustus'),
            9 => __('September'),
            10 => __('Oktober'),
            11 => __('November'),
            12 => __('Desember'),
        ];

        $user = User::find(Auth::user()->id);
        // check for superuser
        $this->areas = $user->id === 1 ? KpiArea::all() : $user->kpi_areas;

        $pref = Pref::where('user_id', $user->id)
            ->where('name', 'kpi-submission')
            ->first();
        $pref = json_decode($pref->data ?? '{}', true);
        $this->area_id = isset($pref['area_id']) ? $pref['area_id'] : '';
        $this->f_year = isset($pref['f_year']) ? $pref['f_year'] : '';
        $this->month = isset($pref['month']) ? $pref['month'] : '';
        $this->status = isset($pref['status']) ? $pref['status'] : '';
    }

    public function updated($property)
    {
        if ($property == 'month') {
            if (isset($this->months[$this->month])) {
                $this->month_name = $this->months[$this->month];
            }
        }
    }

    public function render()
    {
        $this->years = KpiItem::orderBy('year', 'DESC')->select('year')->where('kpi_area_id', $this->area_id)->distinct()->pluck('year');

        // remember preferences
        Pref::updateOrCreate(
            ['user_id' => Auth::user()->id, 'name' => 'kpi-submission'],
            [
                'data' => json_encode([
                    'area_id' => $this->area_id,
                    'f_year' => $this->f_year,
                    'month' => $this->month,
                    'status' => $this->status,
                ]),
            ],
        );

        $items = [];

        $validator = Validator::make(
            [
                'area_id' => $this->area_id,
                'f_year' => $this->f_year,
                'month' => $this->month,
            ],
            [
                'area_id' => 'required|integer|exists:App\Models\KpiArea,id',
                'f_year' => 'required|integer|min:1970|max:9999',
                'month' => 'required|integer|min:1|max:12',
            ],
        );

        if ($validator->passes()) {

            // Create empty kpi scores for selected month if doesn't exists

            $kpi_items = KpiItem::where('kpi_area_id', $this->area_id)
                ->where('year', $this->f_year)
                ->get();

            foreach ($kpi_items as $kpi_item) {
                KpiScore::firstorCreate(
                    [
                        'kpi_item_id' => $kpi_item->id,
                        'month' => $this->month,
                    ],
                    [
                        'user_id' => 1,
                    ],
                );
            }

            // $builder = KpiItem::where('kpi_area_id', $this->area_id)
            //     ->where('year', $this->f_year)
            //     ->orderBy('group', 'ASC')
            //     ->orderBy('order', 'ASC');
            // $grouped_items = $builder->get()->groupBy('group');
            // $item_ids = $grouped_items
            //     ->flatMap(function ($item) {
            //         return $item->pluck('id');
            //     })
            //     ->sort();

            $builder = KpiItem::join('kpi_scores', 'kpi_scores.kpi_item_id', '=', 'kpi_items.id')
                ->where('kpi_items.kpi_area_id', $this->area_id)
                ->where('kpi_items.year', $this->f_year)
                ->where('kpi_scores.month', $this->month)
                ->select(
                    'kpi_items.id as kpi_item_id',
                    'kpi_items.year as kpi_item_year', 
                    'kpi_items.name as kpi_item_name', 
                    'kpi_items.group as kpi_item_group',
                    'kpi_items.order as kpi_item_order',
                    'kpi_scores.id as kpi_score_id',
                    'kpi_scores.month as kpi_score_month', 
                    'kpi_scores.target as kpi_score_target', 
                    'kpi_scores.actual as kpi_score_actual',
                    'kpi_scores.is_submitted as kpi_score_is_submitted'
                )
                ->orderBy('kpi_item_group', 'ASC')
                ->orderBy('kpi_item_order', 'ASC');

            switch ($this->status) {
                case 'draft':
                    $builder->where('kpi_scores.is_submitted', false);
                    break;

                case 'submitted':
                    $builder->where('kpi_scores.is_submitted', true);
                    break;
            }

            $grouped_items = $builder->get()->groupBy('kpi_item_group');

            // Add comments and files count

            foreach ($grouped_items as $group => $items) {

                foreach($items as $key => $item) {

                    $kpi_score = KpiScore::find($item['kpi_score_id']);
    
                    $grouped_items[$group][$key]['comments_count'] = $kpi_score ? $kpi_score->com_items_count() : 0;
                    $grouped_items[$group][$key]['files_count']    = $kpi_score ? $kpi_score->com_files_count() : 0;
                }
            }

            $item_ids = $grouped_items
            ->flatMap(function ($item) {
                return $item->pluck('id');
            })
            ->sort();

        }

        return view('livewire.kpi-submission', compact('grouped_items', 'item_ids'));
    }
}
