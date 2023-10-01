<?php

namespace App\Livewire;

use App\Models\InvUom;
use Livewire\Component;
use Livewire\Attributes\On;

class InvUoms extends Component
{
    public $uoms;

    #[On('updated')]
    public function render()
    {
        $this->uoms = InvUom::all();
        return view('livewire.inv-uoms');
    }
}
