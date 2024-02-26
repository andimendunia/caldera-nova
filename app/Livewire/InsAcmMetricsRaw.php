<?php

namespace App\Livewire;

use Carbon\Carbon;
use Livewire\Component;
use App\Models\InsAcmMetric;
use Livewire\Attributes\Url;
use Livewire\Attributes\Reactive;
use Illuminate\Support\Facades\DB;

class InsAcmMetricsRaw extends Component
{
    #[Reactive]
    public $start_at;

    #[Reactive]
    public $end_at;

    #[Reactive]
    public $fline;

    public $integrity = 0;
    public $accuracy = 0;
    public $days = 0;

    public $perPage = 20;

    public function render()
    {
        $start = Carbon::parse($this->start_at);
        $end = Carbon::parse($this->end_at)->addDay();

        $metrics = InsAcmMetric::whereBetween('dt_client', [$start, $end])->orderBy('dt_client', 'DESC');

        $fline = trim($this->fline);
        if ($fline) {
            $metrics->where('line', 'LIKE', '%' . $fline . '%');
        }

        $metrics = $metrics->paginate($this->perPage);

        // Statistics

        $dayCount = DB::table('ins_acm_metrics')
        ->whereBetween('dt_client', [$start, $end])
        ->selectRaw('COUNT(DISTINCT DATE_FORMAT(dt_client, "%Y-%m-%d")) as day_count')
        ->value('day_count');

        $this->days = (int) $dayCount;

        $hourCount = DB::table('ins_acm_metrics')
            ->whereBetween('dt_client', [$start, $end])
            ->selectRaw('COUNT(DISTINCT DATE_FORMAT(dt_client, "%Y-%m-%d %H")) as hour_count')
            ->value('hour_count');

        $hours = 8; // standard data count in one work day

        $this->integrity = (int) ($this->days > 0 ? (($hourCount / ($dayCount * $hours)) * 100) : 0);

        $this->accuracy = 0;

        if ($metrics->total() > 0) {
            $countAccurate = DB::table('ins_acm_metrics')
                ->whereBetween('rate_act', [0, 10])
                ->whereBetween('dt_client', [$start, $end])
                ->count();
            $this->accuracy = (int) (( $countAccurate / $metrics->total() ) * 100);
        }

        return view('livewire.ins-acm-metrics-raw', compact('metrics'));
    }

    public function loadMore()
    {
        $this->perPage += 10;
    }
}
