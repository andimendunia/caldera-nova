<?php

namespace App\Livewire;

use Carbon\Carbon;
use Livewire\Component;
use Livewire\Attributes\Reactive;
use Illuminate\Support\Facades\DB;

class InsRtmSummary extends Component
{
    #[Reactive]
    public $fline;
    public $perPage = 20;

    public function render()
    {
        $rows = DB::table('ins_rtm_metrics')
        ->select('line')
        ->selectRaw('MAX(dt_client) as dt_client')
        ->selectRaw('SUBSTRING_INDEX(GROUP_CONCAT(thick_act_left ORDER BY dt_client DESC), ",", 1) as thick_act_left')
        ->selectRaw('SUBSTRING_INDEX(GROUP_CONCAT(thick_act_right ORDER BY dt_client DESC), ",", 1) as thick_act_right')
        ->where('dt_client', '>=', Carbon::now()->subDays(90))
        ->groupBy('line');

        $rows = $rows->paginate($this->perPage);
        
        return view('livewire.ins-rtm-summary', compact('rows'));
    }
}
