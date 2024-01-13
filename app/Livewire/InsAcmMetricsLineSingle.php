<?php

namespace App\Livewire;

use Carbon\Carbon;
use Livewire\Component;
use Livewire\Attributes\On;
use App\Models\InsAcmMetric;
use Livewire\Attributes\Reactive;
use Illuminate\Support\Facades\DB;

class InsAcmMetricsLineSingle extends Component
{
    #[Reactive]
    public $sline;

    #[Reactive]
    public $start_at;

    public $dataset = [];
    
    public $data = [];
    public $labels = [];

    public function render()
    {
        $this->data = $this->getData();
        dd($this->data);
        $this->labels = $this->getLabels();

        $this->dataset = [
            [
                'label' => __('Laju (det/psg)'),
                'backgroundColor' => 'rgba(15,64,97,255)',
                'borderColor' => 'rgba(15,64,97,255)',
                'data' => $this->data['rate_act'],
            ],
            [
                'label' => __('Min'),
                'backgroundColor' => 'rgba(212,212,212,255)',
                'borderColor' => 'rgba(212,212,212,255)',
                'data' => $this->data['rate_min'],
            ],
        ];

        return view('livewire.ins-acm-metrics-line-single');
    }

    public function getData()
    {
        $start  = Carbon::parse($this->start_at);
        $end    = Carbon::parse($this->start_at)->addDay();

        $rawData = DB::table('ins_acm_metrics')
        ->whereBetween('dt_client', [$start, $end])
        ->where('line', $this->sline)
        ->select(
            // MYSQL
            // DB::raw('DATE_FORMAT(dt_client, "%H:") as time_interval'),
            // DB::raw('(MINUTE(dt_client) DIV 15 * 15) as rounded_minutes'),
            // DB::raw('CONCAT((MINUTE(dt_client) DIV 15 * 15), ":00") as formatted_minutes'),
            // DB::raw('AVG(rate_act)'),
            // DB::raw('MIN(rate_min)'),
            // DB::raw('MAX(rate_max)')
            // SQLITE
            DB::raw('strftime("%H:", dt_client) || printf("%02d", (strftime("%M", dt_client) / 15 * 15)) as time_interval'),
            DB::raw('AVG(rate_act)'),
            DB::raw('AVG(rate_min)'),
            DB::raw('AVG(rate_max)')
        )
        ->groupBy('time_interval')
        ->orderBy('time_interval')
        ->get();

        return $rawData;

        return [
            'rate_min' => $rawData->pluck('rate_min')->toArray(),
            'rate_max' => $rawData->pluck('rate_max')->toArray(),
            'rate_act' => $rawData->pluck('rate_act')->toArray(),
            'time_interval' => $rawData->pluck('time_interval')->toArray(),
        ];

        return [
            'rate_min' => [7,7,7],
            'rate_max' => [100,100,100],
            'rate_act' => [8,9,8],
            'time_interval' => ['00:00', '00:15', '00:30'],
        ];
    }

    public function getLabels()
    {
        $labels = [];
        foreach($this->data['time_interval'] as $time)
        {
            $labels[] = $time;
        }
        return $labels;
    }

    // public function updated($property, $value)
    // {
    //     if ($property === 'sline') {
    //         $labels = $this->getLabels();

    //         $dataset = [
    //             [
    //                 'label' => 'Logged In',
    //                 'backgroundColor' => 'rgba(15,64,97,255)',
    //                 'borderColor' => 'rgba(15,64,97,255)',
    //                 'data' => $this->getData(),
    //             ],
    //         ];

    //         $this->dispatch('updateChart', [
    //             'datasets' => $dataset,
    //             'labels' => $labels,
    //         ]); 
    //     }
    // }






}
