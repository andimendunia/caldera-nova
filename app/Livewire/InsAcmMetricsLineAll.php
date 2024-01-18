<?php

namespace App\Livewire;

use Carbon\Carbon;
use Livewire\Component;
use App\Models\InsAcmMetric;
use Livewire\Attributes\Reactive;
use Illuminate\Support\Facades\DB;

class InsAcmMetricsLineAll extends Component
{
    #[Reactive]
    public $fline;
    public $perPage = 20;

    public function render()
    {
        $rows = DB::table('ins_acm_metrics')
        ->select('line')
        ->selectRaw('MAX(dt_client) as dt_client')
        ->selectRaw('SUBSTRING_INDEX(GROUP_CONCAT(rate_act ORDER BY dt_client DESC), ",", 1) as rate_act')
        ->where('dt_client', '>=', Carbon::now()->subDays(90))
        ->groupBy('line');

        $rows = $rows->paginate($this->perPage);
        
        return view('livewire.ins-acm-metrics-line-all', compact('rows'));
    }
}
