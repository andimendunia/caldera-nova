<?php

namespace App\Livewire;

use App\Models\InvArea;
use Livewire\Component;
use Livewire\Attributes\On;

class InvAreas extends Component
{
    public $areas;

    #[On('updated')]
    public function render()
    {
        $this->areas = InvArea::all();
        return view('livewire.inv-areas');
    }
}
