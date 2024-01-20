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
        $metrics = InsAcmMetric::where('line', $this->sline)
            ->whereBetween('dt_client', [$start_at, $end_at])
            ->get();

        // dd($metrics);
        
        // Transform the data into the required format
        $data = [];
        
        foreach ($metrics as $metric) {      
            $dt = $metric->dt_client;
            $data['rate_act'][$dt->toIso8601String()] = $metric->rate_act;
        }
        

        $max = (int) max($data['rate_act'] ?? [0]);
        $min = (int) min($data['rate_act'] ?? [0]);
        
        $lineChartModel = (new LineChartModel())
            ->multiLine()
            ->withLegend()
            ->setTitle($this->sline)
            ->setJsonConfig([
                'markers.size' => "[2]",
                'markers.colors' => "'#525252'",
                'markers.strokeWidth' => 0,
                'xaxis.type' => "'datetime'",
                'xaxis.labels.datetimeUTC' => false,
                'yaxis.decimalsInFloat' => "1",
                'yaxis.max' => $max + 1,
                'yaxis.min' => $min - 1,
                'colors' => "['#A3A3A3']",
                'tooltip.x.format' => "'HH:mm'"
            ]);

            $dict = [
                'rate_act' => __('Laju'),
                'rate_min' => __('Minimum'),
                'rate_max' => __('Maksimum')
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
