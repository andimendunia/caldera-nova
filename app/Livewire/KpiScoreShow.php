<?php

namespace App\Livewire;

use Livewire\Component;

class KpiScoreShow extends Component
{
    public $item;
    public $score;
    
    public $months;

    public function mount()
    {
        $this->months = [
            1 => __('Januari'),
            2 => __('Februari'),
            3 => __('Maret'),
            4 => __('April'),
            5 => __('Mei'),
            6 => __('Juni'),
            7 => __('Juli'),
            8 => __('Agustus'),
            9 => __('September'),
            10 => __('Oktober'),
            11 => __('November'),
            12 => __('Desember'),
        ];
    }

    public function render()
    {
        return view('livewire.kpi-score-show');
    }
}
