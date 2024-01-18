<?php

namespace App\Livewire;

use Carbon\Carbon;
use Livewire\Component;
use Livewire\Attributes\On;
use App\Models\InsAcmMetric;
use Livewire\Attributes\Reactive;
use Illuminate\Support\Facades\DB;
use Asantibanez\LivewireCharts\Models\LineChartModel;

class InsAcmMetricsLineSingle extends Component
{
    #[Reactive]
    public $sline;

    #[Reactive]
    public $start_at;

    public function render()
    {
        // $data = [
        //     'Laju' => [
        //         '08:00' => 8,
        //         '08:10' => 8,
        //         '08:20' => 8,
        //     ],
        //     'Min' => [
        //         '08:00' => 7,
        //         '08:10' => 7,
        //         '08:20' => 7,
        //     ],
        // ];

        // Assuming $startDateTime and $endDateTime are your desired date range
        // You need to replace these with your actual date range

        $start_at  = Carbon::parse($this->start_at);
        $end_at    = Carbon::parse($this->start_at)->addDay();

        // Fetch data from the database
        $metricsData = InsAcmMetric::selectRaw('ROUND(TO_SECONDS(dt_client) / (15 * 60)) * (15 * 60) AS interval_start, AVG(rate_act) AS avg_rate_act, AVG(rate_min) AS avg_rate_min')
            ->where('line', $this->sline)
            ->where('dt_client', '>=', $start_at)
            ->where('dt_client', '<=', $end_at)
            ->groupBy('interval_start') // Group by every 10 minutes
            ->get();
        
        // Transform the data into the required format
        $data = [];
        
        foreach ($metricsData as $metric) {
            $time = Carbon::createFromTimestampUTC($metric->interval_start)->format('H:i');
            
            $data['avg_rate_act'][$time] = $metric->avg_rate_act;
            $data['avg_rate_min'][$time] = $metric->avg_rate_min;
        }
        
        $lineChartModel = (new LineChartModel())
            ->multiLine()
            ->withLegend()
            ->setTitle($this->sline);

            foreach ($data as $seriesName => $seriesData) {
                foreach ($seriesData as $time => $value) {
                    $lineChartModel->addSeriesPoint(__($seriesName), $time, $value);
                }
            }

        return view('livewire.ins-acm-metrics-line-single', compact('lineChartModel'));
    }
}
