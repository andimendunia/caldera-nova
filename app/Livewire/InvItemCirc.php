<?php

namespace App\Livewire;

use Livewire\Component;

class InvItemCirc extends Component
{
    public $id;
    
    public $qty = '';
    public $qty_main;
    public $qty_used;
    public $qty_rep;
    public $qty_main_min;
    public $qty_main_max;
    public $curr;
    public $price;
    public $uom;

    public function render()
    {
        return view('livewire.inv-item-circ');
    }
}
