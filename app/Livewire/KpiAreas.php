<?php

namespace App\Livewire;

use App\Models\KpiArea;
use Livewire\Component;
use Livewire\Attributes\On;

class KpiAreas extends Component
{
    public $areas;

    #[On('updated')]
    public function render()
    {
        $this->areas = KpiArea::all();
        return view('livewire.kpi-areas');
    }
}
