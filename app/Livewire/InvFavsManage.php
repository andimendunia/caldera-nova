<?php

namespace App\Livewire;

use Livewire\Component;

class InvFavsManage extends Component
{

    public $qloc;
    public $qtag;

    public $locs;
    public $tags;

    public function placeholder()
    {
        return view('livewire.modal-placeholder');
    }

    public function render()
    {
        return view('livewire.inv-favs-manage');
    }
}
