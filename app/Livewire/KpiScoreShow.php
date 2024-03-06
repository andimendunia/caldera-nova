<?php

namespace App\Livewire;

use App\Models\KpiItem;
use Livewire\Component;
use App\Models\KpiScore;
use Livewire\Attributes\Url;

class KpiScoreShow extends Component
{
    public KpiItem $item;
    public KpiScore $score;

    public $target;
    public $actual;
    public $is_submitted;
    
    public $month_name;

    public function mount(KpiScore $score)
    {
        $this->score = $score;

        $this->target       = (int) $score->target;
        $this->actual       = (int) $score->actual;
        $this->is_submitted = (bool) $score->is_submitted;
    }

    public function render()
    {
        return view('livewire.kpi-score-show');
    }

    public function update()
    {
        // update: add validation

        $this->score->update([
            'target'        => $this->target,
            'actual'        => $this->actual,
            'is_submitted'  => $this->is_submitted
        ]);
        $this->js('notyf.success("'.__('Skor KPI diperbarui').'")'); 
    }
}
