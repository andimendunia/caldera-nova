<?php

namespace App\Livewire;

use App\Models\Pref;
use App\Models\User;
use App\Models\KpiArea;
use App\Models\KpiItem;
use Livewire\Component;
use App\Models\KpiScore;
use Livewire\Attributes\Url;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class KpiOverview extends Component
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
    // public $month_name;

    public function mount()
    {
        $this->months = [
            1 => __('Jan'),
            2 => __('Feb'),
            3 => __('Mar'),
            4 => __('Apr'),
            5 => __('Mei'),
            6 => __('Jun'),
            7 => __('Jul'),
            8 => __('Agt'),
            9 => __('Sep'),
            10 => __('Okt'),
            11 => __('Nov'),
            12 => __('Des'),
        ];
        
        $user = User::find(Auth::user()->id);
        // check for superuser
        $this->areas = $user->id === 1 ? KpiArea::all() : $user->kpi_areas;

        $pref = Pref::where('user_id', $user->id)
        ->where('name', 'kpi-overview')
        ->first();
        $pref = json_decode($pref->data ?? '{}', true);
        $this->area_id = isset($pref['area_id']) ? $pref['area_id'] : '';
        $this->f_year = isset($pref['f_year']) ? $pref['f_year'] : '';
        $this->month = isset($pref['month']) ? $pref['month'] : '';
    }
    
    public function render()
    {
        $this->years = KpiItem::orderBy('year', 'DESC')->select('year')->where('kpi_area_id', $this->area_id)->distinct()->pluck('year');

        // remember preferences
        Pref::updateOrCreate(
            ['user_id' => Auth::user()->id, 'name' => 'kpi-overview'],
            [
                'data' => json_encode([
                    'area_id' => $this->area_id,
                    'f_year' => $this->f_year,
                    'month' => $this->month,
                ]),
            ],
        );

        $items = [];

        $validator = Validator::make(
            [
                'area_id' => $this->area_id,
                'f_year' => $this->f_year,
            ],
            [
                'area_id' => 'required|integer|exists:App\Models\KpiArea,id',
                'f_year' => 'required|integer|min:1970|max:9999',
            ],
        );

        if ($validator->passes()) {

            $items = KpiItem::where('kpi_area_id', $this->area_id)
            ->where('year', $this->f_year)
            ->get()->toArray();

            foreach ($items as $key => $item) {

                foreach (range(1, 12) as $i) {
                    $score = KpiScore::where('kpi_item_id', $item['id'])->where('month', $i)->first();
                    $items[$key][$i] = [
                        'kpi_score_id'      => $score ? $score->id : '',
                        'target'            => $score ? (int) $score->target : '',
                        'actual'            => $score ? (int) $score->actual : '',
                        'comments_count'    => $score ? $score->com_items_count() : 0,
                        'files_count'       => $score ? $score->com_files_count() : 0,                     
                    ];
                }
            }
        }

        return view('livewire.kpi-overview', compact('items'));
    }
}
