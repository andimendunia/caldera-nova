<?php

namespace App\Livewire;

use App\Models\User;
use App\Models\InvArea;
use Livewire\Component;

class InvAuthsCreate extends Component
{
    public $userq;
    public $user_id;

    public $area_id;
    public $actions = [];

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
        $this->userq = trim($this->userq);
        // delegate to...
        if ($this->userq) {
            $user = User::where('emp_id', $this->userq)->first();
            $this->user_id = $user ? $user->id : '';
        }
        dd($this);
    }
    
    public function updatedUserq()
    {
        $this->dispatch('userq-updated', $this->userq);
    }
}
