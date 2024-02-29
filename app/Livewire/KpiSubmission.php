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

class KpiSubmission extends Component
{
    #[Url]
    public $area_id;
    public $areas;

    #[Url]
    public $year;

    #[Url]
    public $month;

    #[Url]
    public $status ;

    public function mount()
    {
        $user = User::find(Auth::user()->id);
        // check for superuser
        $this->areas = $user->id === 1 ? KpiArea::all() : $user->kpi_areas;

        $pref = Pref::where('user_id', $user->id)->where('name', 'kpi-submission')->first();
        $pref = json_decode($pref->data ?? '{}', true);
        $this->area_id  = isset($pref['area_id'])   ? $pref['area_id']  : '';
        $this->year     = isset($pref['year'])      ? $pref['year']     : '';
        $this->month    = isset($pref['month'])     ? $pref['month']    : '';
        $this->status   = isset($pref['status'])    ? $pref['status']   : 'all';
    }

    public function render()
    {
        // remember preferences
        $pref = Pref::updateOrCreate(
            ['user_id' => Auth::user()->id, 'name' => 'kpi-submission'],
            [
                'data' => json_encode([
                    'area_id'   => $this->area_id,
                    'year'      => $this->year,
                    'month'     => $this->month,
                    'status'    => $this->status,
                ]),
            ],
        );

        // change to better validation, maybe manual?
        // if($this->area_id && $this->year && $this->month) {

        //     $items = KpiItem::where('area_id', $this->area_id)->where('year', $this->year)->get();

        //     foreach($items as $item) {
        //         $scores[] = KpiScore::firstOrCreate([
        //             ['user_id' => 1 ],
        //             ['kpi_item_id' => $item->id],
        //             ['month' => $this->month ]
        //         ]);
        //     }
        // }


        
        return view('livewire.kpi-submission', 'scores');
    }
}
