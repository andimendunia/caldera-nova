<?php

namespace App\Livewire;

use Carbon\Carbon;
use Livewire\Component;
use App\Models\InsAcmMetric;
use Livewire\Attributes\Url;
use Livewire\Attributes\Reactive;

class InsAcmMetricsRaw extends Component
{
    #[Reactive]
    public $start_at;

    #[Reactive]
    public $end_at;

    #[Reactive]
    public $f_line;

    public $perPage = 20;

    public function render()
    {
        $start  = Carbon::parse($this->start_at);
        $end    = Carbon::parse($this->end_at)->addDay();

        $metrics = InsAcmMetric::whereBetween('dt_client', [$start, $end])->orderBy('dt_client', 'DESC');

        $f_line = trim($this->f_line);
        if($f_line) {
            $metrics->where('line', 'LIKE', '%' . $f_line . '%');
        }

        $metrics = $metrics->paginate($this->perPage);

        return view('livewire.ins-acm-metrics-raw', compact('metrics'));
    }

    public function loadMore()
    {
        $this->perPage += 10;
    }
}
