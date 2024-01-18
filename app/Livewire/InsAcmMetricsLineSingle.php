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
        $start_at  = Carbon::parse($this->start_at);
        $end_at    = Carbon::parse($this->start_at)->addDay();

        // Fetch data from the database
        $metricsData = InsAcmMetric::selectRaw('ROUND(TO_SECONDS(dt_client) / (15 * 60)) * (15 * 60) AS interval_start, AVG(rate_act) AS avg_rate_act, AVG(rate_min) AS avg_rate_min')
            ->where('line', $this->sline)
            ->whereBetween('dt_client', [$start_at, $end_at])
            ->orderBy('interval_start')
            ->groupBy('interval_start') 
            ->get();
        
        // Transform the data into the required format
        $data = [];
        
        foreach ($metricsData as $metric) {
            $time = Carbon::createFromTimestamp($metric->interval_start)->format('Y-m-d H:i');
            
            $data['avg_rate_act'][$time] = $metric->avg_rate_act;
            $data['avg_rate_min'][$time] = $metric->avg_rate_min;
        }
        
        $lineChartModel = (new LineChartModel())
            ->multiLine()
            ->withLegend()
            ->setTitle($this->sline)
            ->setJsonConfig([
                'xaxis.type' => "'datetime'",
                'yaxis.decimalsInFloat' => 1,
                'colors' => "['#737373', '#D4D4D4']"
            ]);

            $dict = [
                'avg_rate_act' => __('Laju rata-rata'),
                'avg_rate_min' => __('Minimum'),
                'avg_rate_max' => __('Maksimum')
            ];

            foreach ($data as $seriesName => $seriesData) {
                $displayName = isset($dict[$seriesName]) ? $dict[$seriesName] : $seriesName;

                foreach ($seriesData as $time => $value) {
                    $lineChartModel->addSeriesPoint($displayName, $time, $value);
                }
            }

        return view('livewire.ins-acm-metrics-line-single', compact('lineChartModel'));
    }
}
