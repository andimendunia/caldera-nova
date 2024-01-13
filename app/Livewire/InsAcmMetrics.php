<?php

namespace App\Livewire;

use Carbon\Carbon;
use Livewire\Component;
use App\Models\InsAcmMetric;
use Livewire\Attributes\Url;
use Livewire\Attributes\Reactive;

class InsAcmMetrics extends Component
{
    #[Url]
    public $view = 'line-all';

    #[Url]
    public $start_at;

    #[Url]
    public $end_at;

    #[Url]
    public $fline;

    #[Url]
    public $sline;
    public $olines = [];

    public $lineViews   = ['line-single'];
    public $dateViews   = ['raw', 'line-single'];
    public $rangeViews  = ['raw'];
    public $filterViews = ['raw', 'line-all'];

    public $is_line;
    public $is_date;
    public $is_range;
    public $is_filter;

    public function mount()
    {
        $this->setToday();
        $this->olines = InsAcmMetric::select('line')
        ->distinct()
        ->orderBy('line')
        ->get()
        ->pluck('line')
        ->toArray();
    }

    public function render()
    {
        $this->is_date      = in_array($this->view, $this->dateViews);
        $this->is_range     = in_array($this->view, $this->rangeViews);
        $this->is_line      = in_array($this->view, $this->lineViews);
        $this->is_filter    = in_array($this->view, $this->filterViews);

        return view('livewire.ins-acm-metrics', ['start_at' => $this->start_at, 'end_at' => $this->end_at, 'fline' => $this->fline ]);
    }

    public function setToday()
    {
        $this->start_at = Carbon::now()->startOfDay()->format('Y-m-d');
        $this->end_at = Carbon::now()->endOfDay()->format('Y-m-d');
    }

    public function setYesterday()
    {
        $this->start_at = Carbon::yesterday()->startOfDay()->format('Y-m-d');
        $this->end_at = Carbon::yesterday()->endOfDay()->format('Y-m-d');
    }

    public function setThisMonth()
    {
        $this->start_at = Carbon::now()->startOfMonth()->format('Y-m-d');
        $this->end_at = Carbon::now()->endOfMonth()->format('Y-m-d');
    }

    public function setLastMonth()
    {
        $this->start_at = Carbon::now()->subMonthNoOverflow()->startOfMonth()->format('Y-m-d');
        $this->end_at = Carbon::now()->subMonthNoOverflow()->endOfMonth()->format('Y-m-d');
    }

    public function resetFilter()
    {
        $this->reset('fline');
    }
}
