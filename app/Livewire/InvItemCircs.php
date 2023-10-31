<?php

namespace App\Livewire;

use App\Models\InvCirc;
use Livewire\Component;
use Livewire\Attributes\On;
use Livewire\WithPagination;

class InvItemCircs extends Component
{
    use WithPagination;

    public $id;
    public $perPage = 10;

    public function placeholder()
    {
        return view('livewire.modal-placeholder');
    }

    #[On('updated')]
    public function render()
    {
        $circs = InvCirc::orderByDesc('updated_at')->where('inv_item_id', $this->id)->paginate($this->perPage);
        return view('livewire.inv-item-circs', compact('circs'));
    }
}
