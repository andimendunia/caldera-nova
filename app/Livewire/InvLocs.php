<?php

namespace App\Livewire;

use App\Models\InvLoc;
use App\Models\InvArea;
use Livewire\Component;
use Livewire\Attributes\On;

class InvLocs extends Component
{
    public $locs;
    public $areas;

    #[On('updated')]
    public function render()
    {
        $this->locs = InvLoc::all();
        $this->areas = InvArea::all();
        return view('livewire.inv-locs');
    }
}
