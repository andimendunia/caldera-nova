<?php

namespace App\Livewire;

use App\Models\InvCirc;
use Livewire\Component;

class InvCircEdit extends Component
{
    public InvCirc $circ;
    
    public function placeholder()
    {
        return view('livewire.modal-placeholder');
    }

    public function render()
    {
        return view('livewire.inv-circ-edit');
    }
}
