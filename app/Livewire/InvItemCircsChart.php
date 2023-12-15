<?php

namespace App\Livewire;

use Livewire\Component;

class InvItemCircsChart extends Component
{
    public $id;

    public function placeholder()
    {
        return view('livewire.modal-placeholder');
    }

    public function render()
    {
        return view('livewire.inv-item-circs-chart');
    }
}
