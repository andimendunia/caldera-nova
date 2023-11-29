<?php

namespace App\Livewire;

use Livewire\Component;

class InvMassEdit extends Component
{
    public $isValid = false;
    public function render()
    {
        return view('livewire.inv-mass-edit');
    }
}
