<?php

namespace App\Livewire;

use App\Models\InvCirc;
use Livewire\Component;

class InvItemCircs extends Component
{
    public $id;

    public function placeholder()
    {
        return view('livewire.modal-placeholder');
    }

    public function render()
    {

        $circs = InvCirc::orderByDesc('updated_at')->where('inv_item_id', $this->id)->get();
        return view('livewire.inv-item-circs', compact('circs'));
    }
}
