<?php

namespace App\Livewire;

use App\Models\InvCurr;
use Livewire\Component;
use Livewire\Attributes\Rule;

class InvCurrsCreate extends Component
{
    #[Rule('required|alpha:ascii|size:3|unique:inv_currs,name')]
    public $name;

    #[Rule('required|numeric|min:1|max:100000')]
    public $rate;

    public function placeholder()
    {
        return view('livewire.modal-placeholder');
    }

    public function render()
    {
        return view('livewire.inv-currs-create');
    }

    public function save()
    {
        $this->name = strtoupper($this->name);
        $validated = $this->validate();

        InvCurr::create($validated);
        $this->reset(['name', 'rate']);
        $this->dispatch('curr-created');
    }
}
