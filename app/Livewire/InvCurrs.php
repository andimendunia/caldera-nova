<?php

namespace App\Livewire;

use App\Models\InvCurr;
use Livewire\Component;
use Livewire\Attributes\On;

class InvCurrs extends Component
{
    public $currs;
    
    #[On('created')]
    #[On('updated')]
    #[On('deleted')]
    public function render()
    {
        $this->currs = InvCurr::all();
        return view('livewire.inv-currs');
    }    
}
