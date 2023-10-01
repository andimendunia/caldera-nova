<?php

namespace App\Livewire;

use App\Models\InvArea;
use Livewire\Component;
use Livewire\Attributes\Rule;

class InvAreasCreate extends Component
{
    #[Rule('required|min:1|max:20|unique:inv_areas,name')]
    public $name = '';

    public function placeholder()
    {
        return view('livewire.modal-placeholder');
    }

    public function render()
    {
        return view('livewire.inv-areas-create');
    }

    public function save()
    {
        $validated = $this->validate();

        InvArea::create($validated);
        $this->reset(['name']);
        $this->js('window.dispatchEvent(escKey)'); 
        $this->js('notyf.success("'.__('Area inventaris dibuat').'")'); 
        $this->dispatch('updated');

    }
}
