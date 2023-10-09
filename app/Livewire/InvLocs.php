<?php

namespace App\Livewire;

use App\Models\InvLoc;
use Livewire\Component;
use Livewire\Attributes\On;

class InvLocs extends Component
{
    public $locs;

    #[On('updated')]
    public function render()
    {
        $this->locs = InvLoc::all();
        return view('livewire.inv-locs');
    }
}
