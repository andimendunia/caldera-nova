<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\InsAcmMetric;
use Livewire\Attributes\Reactive;

class InsAcmMetricsLineAll extends Component
{
    #[Reactive]
    public $fline;
    public $perPage = 20;

    public function render()
    {
        $rows = InsAcmMetric::where('dt_client', '>=', now()->subDays(90))
        ->select([
            'line',
            'rate_act',  // Select the rate_act directly
            'dt_client'
        ]);

        $fline = trim($this->fline);
        if($fline) {
            $rows->where('line', 'LIKE', '%' . $fline . '%');
        }

        $rows = $rows
        ->groupBy('line')
        ->orderBy('line', 'asc')  // Sort by dt_client descending
        ->take(1);

        $rows = $rows->paginate($this->perPage);
        
        return view('livewire.ins-acm-metrics-line-all', compact('rows'));
    }
}
