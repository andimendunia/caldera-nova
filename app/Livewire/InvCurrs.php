<?php

namespace App\Livewire;

use App\Models\InvCurr;
use Livewire\Component;
use Livewire\Attributes\On;

class InvCurrs extends Component
{
    public $currs;
    
    #[On('updated')]
    public function render()
    {
        $this->currs = InvCurr::all();
        return view('livewire.inv-currs');
    }    
}
