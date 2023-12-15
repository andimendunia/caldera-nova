<?php

namespace App\Livewire;

use Livewire\Component;

class InvItemCircsDownload extends Component
{
    public function placeholder()
    {
        return view('livewire.modal-placeholder');
    }
    
    public function render()
    {
        return view('livewire.inv-item-circs-download');
    }

    
}
