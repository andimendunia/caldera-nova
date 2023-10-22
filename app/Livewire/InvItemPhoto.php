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

    public $mode;
    public $id;
    public $url;

    public function mount()
    {
        switch ($this->mode) {
            case 'show':
                break;
            case 'create':
                # code...
                break;
            case 'edit':
                # code...
                break;
            default:
                return abort('403', 'Missing parameter at InvItemPhoto');
                break;
        }
    }

    public function render()
    {
        return view('livewire.inv-item-photo');
    }

    public function updatedPhoto()
    {
        $filename = $this->photo ? $this->photo->getFilename() : '';
        $this->dispatch('photo-updated', photo: $filename);
    }
}
