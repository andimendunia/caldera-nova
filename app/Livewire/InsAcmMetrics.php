<?php

namespace App\Livewire;

use Carbon\Carbon;
use Livewire\Component;
use Livewire\Attributes\Url;
use Livewire\Attributes\Reactive;

class InsAcmMetrics extends Component
{
    #[Url]
    public $view;

    #[Url]
    public $start_at;

    #[Url]
    public $end_at;

    #[Url]
    public $f_line;

    public $is_range;
    
    public function render()
    {
        $this->is_range = $this->view == 'raw' ? true : false;
        return view('livewire.ins-acm-metrics', ['start_at' => $this->start_at, 'end_at' => $this->end_at, 'f_line' => $this->f_line ]);
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
        $this->reset('f_line');
    }
}
