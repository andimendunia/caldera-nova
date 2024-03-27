<?php

namespace App\Livewire;

use Carbon\Carbon;
use Livewire\Component;
use App\Models\InsRtmMetric;
use Livewire\Attributes\Reactive;
use Illuminate\Support\Facades\DB;

class InsRtmRaw extends Component
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
        $fline = trim($this->fline);

        $metrics = InsRtmMetric::whereBetween('dt_client', [$start, $end])
            ->where('line', 'LIKE', '%' . $fline . '%')
            ->orderBy('dt_client', 'DESC');

        $metrics = $metrics->paginate($this->perPage);

        // Statistics

        // hitung tanggal, jam, line
        $numeratorIntegrity = DB::table('ins_rtm_metrics')
            ->select(DB::raw('CONCAT(DATE(dt_client), LPAD(HOUR(dt_client), 2, "0"), line) as date_hour_line'))
            ->whereBetween('dt_client', [$start, $end])
            ->where('line', 'LIKE', '%' . $fline . '%')
            ->groupBy('date_hour_line')
            ->get()
            ->count();

        // hitung tanggal, line
        $denominatorIntegrity =
            DB::table('ins_rtm_metrics')
                ->select(DB::raw('CONCAT(DATE(dt_client), line) as date_line'))
                ->whereBetween('dt_client', [$start, $end])
                ->where('line', 'LIKE', '%' . $fline . '%')
                ->groupBy('date_line')
                ->get()
                ->count() * 8;

        // hitung tanggal
        $this->days = DB::table('ins_rtm_metrics')
            ->select(DB::raw('DATE(dt_client) as date'))
            ->whereBetween('dt_client', [$start, $end])
            ->where('line', 'LIKE', '%' . $fline . '%')
            ->groupBy('date')
            ->get()
            ->count();

        if ($denominatorIntegrity > 0) {
            $this->integrity = (int) (($numeratorIntegrity / $denominatorIntegrity) * 100);
        }

        $numeratorAccuracy = InsRtmMetric::whereBetween('dt_client', [$start, $end])
            ->where('line', 'LIKE', '%' . $fline . '%') 
            ->whereBetween('thick_act_left', [0, 6])
            ->whereBetween('thick_act_right', [0, 6])
            ->get()
            ->count();

        $denominatorAccuracy = InsRtmMetric::whereBetween('dt_client', [$start, $end])
            ->where('line', 'LIKE', '%' . $fline . '%')
            ->get()
            ->count();

        if ($denominatorAccuracy > 0) {
            $this->accuracy = (int) (($numeratorAccuracy / $denominatorAccuracy) * 100);
        }

        return view('livewire.ins-rtm-raw', compact('metrics'));
    }

    public function loadMore()
    {
        $this->perPage += 10;
    }
}
