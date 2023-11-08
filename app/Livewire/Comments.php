<?php

namespace App\Livewire;

use Livewire\Component;

class Comments extends Component
{
    public $mod;
    public $userq;

    public function render()
    {
        return view('livewire.comments');
    }

    public function updatedUserq()
    {
        $this->dispatch('userq-updated', $this->userq);
    }
}
