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

        $grouped_items = [];

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

            $builder = KpiItem::where('kpi_area_id', $this->area_id)
            ->where('year', $this->f_year)
            ->orderBy('group', 'ASC')
            ->orderBy('order', 'ASC');

            $grouped_items = $builder->get()->groupBy('group');

            foreach($grouped_items as $group => $items) {

                foreach ($items as $key => $item) {

                    $sum_target = 0;
                    $sum_actual = 0;
                    foreach (range(1, 12) as $i) {
                        $score = KpiScore::where('kpi_item_id', $item['id'])->where('month', $i)->first();
                        
                        $target = $score ? (double) $score->target : '';
                        $actual = $score ? (double) $score->actual : '';

                        $ratio = $target > 0 ? ($actual / $target) : 0;

                        $grade = 'red';

                        if ($ratio >= 0.95) {
                            $grade = 'green';
                        } elseif ($ratio >= 0.85 && $ratio < 0.95) {
                            $grade = 'orange';
                        } elseif ($target == 0 && $actual == 0) {
                            $grade = 'green';
                        }
                        

                        $grouped_items[$group][$key][$i] = [
                            'kpi_score_id'      => $score ? (int) $score->id : '',
                            'target'            => $target,
                            'actual'            => $actual,
                            'is_submitted'      => $score ? (bool) $score->is_submitted : false,
                            'comments_count'    => $score ? $score->com_items_count() : 0,
                            'files_count'       => $score ? $score->com_files_count() : 0,
                            'grade'             => $grade,                   
                        ];
                        $sum_target += (double) $grouped_items[$group][$key][$i]['target'];
                        $sum_actual += (double) $grouped_items[$group][$key][$i]['actual'];
                    }

                    $grouped_items[$group][$key]['sum_target'] = $sum_target;
                    $grouped_items[$group][$key]['sum_actual'] = $sum_actual;
                }
            }

            // dd($grouped_items);


        }

        return view('livewire.kpi-overview', compact('grouped_items'));
    }
}
