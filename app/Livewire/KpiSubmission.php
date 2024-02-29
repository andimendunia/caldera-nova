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
    public $year;

    #[Url]
    public $month;
    public $months;
    public $month_name;

    #[Url]
    public $status;

    public function mount()
    {
        $user = User::find(Auth::user()->id);
        // check for superuser
        $this->areas = $user->id === 1 ? KpiArea::all() : $user->kpi_areas;

        $pref = Pref::where('user_id', $user->id)
            ->where('name', 'kpi-submission')
            ->first();
        $pref = json_decode($pref->data ?? '{}', true);
        $this->area_id = isset($pref['area_id']) ? $pref['area_id'] : '';
        $this->year = isset($pref['year']) ? $pref['year'] : '';
        $this->month = isset($pref['month']) ? $pref['month'] : '';
        $this->status = isset($pref['status']) ? $pref['status'] : 'all';

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
    }

    public function updated($property)
    {
        if ($property == 'month') {
            if(isset($this->months[$this->month])) {
                $this->month_name = $this->months[$this->month];
            }
        } 
    }

    public function render()
    {
        // remember preferences
        $pref = Pref::updateOrCreate(
            ['user_id' => Auth::user()->id, 'name' => 'kpi-submission'],
            [
                'data' => json_encode([
                    'area_id' => $this->area_id,
                    'year' => $this->year,
                    'month' => $this->month,
                    'status' => $this->status,
                ]),
            ],
        );

        $items = new Collection([]);

        $validator = Validator::make([
            'area_id'   => $this->area_id,
            'year'      => $this->year,
            'month'     => $this->month,
        ], [
            'area_id'   => 'required|integer|exists:App\Models\KpiArea,id',
            'year'      => 'required|integer|min:1970|max:9999',
            'month'     => 'required|integer|min:1|max:12',
        ]);

        if ($validator->passes()) {   
            $items = KpiItem::where('kpi_area_id', $this->area_id)->where('year', $this->year)->get();    
        } 

        return view('livewire.kpi-submission', compact('items'));
    }
}
