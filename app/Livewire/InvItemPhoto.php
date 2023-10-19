<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\Rule;
use Livewire\WithFileUploads;

class InvItemPhoto extends Component
{
    use WithFileUploads;
    
    #[Rule('image|max:1024')] // 1MB Max
    public $photo;

    public function render()
    {
        return view('livewire.inv-item-photo');
    }
}
