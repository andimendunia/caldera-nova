<?php

namespace App\Livewire;

use App\Models\InvArea;
use Livewire\Component;
use Livewire\Attributes\Rule;

class InvItemsFirst extends Component
{
    public $code;
    public $areas;

    #[Rule('required')]
    public $area_id;

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
        return view('livewire.inv-items-first');
    }

    public function first()
    {
        $this->code = trim($this->code);
        dd($this->code);
        $this->validate();
    }
}
