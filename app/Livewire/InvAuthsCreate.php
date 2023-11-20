<?php

namespace App\Livewire;

use App\Models\InvArea;
use Livewire\Component;

class InvAuthsCreate extends Component
{
    public $areas;

    public function placeholder()
    {
        return view('livewire.modal-placeholder');
    }

    public function mount()
    {
        $this->areas = InvArea::all();
    }

    public function render()
    {
        return view('livewire.inv-auths-create');
    }

    public function save()
    {
        $this->js('alert("place code here")');
    }
}
