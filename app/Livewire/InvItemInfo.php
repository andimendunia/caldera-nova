<?php

namespace App\Livewire;

use Livewire\Component;

class InvItemInfo extends Component
{
    public $id;
    public $loc;
    public $tags;

    public function render()
    {
        return view('livewire.inv-item-info');
    }
}
