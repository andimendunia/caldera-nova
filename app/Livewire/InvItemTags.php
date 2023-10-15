<?php

namespace App\Livewire;

use Livewire\Component;

class InvItemTags extends Component
{
    public $tags = [];

    public function mount()
    {
        //
    }

    public function placeholder()
    {
        return view('livewire.modal-placeholder');
    }

    public function render()
    {
        return view('livewire.inv-item-tags');
    }

    public function addTag()
    {
        $this->tags[] = '';
    }

    public function removeTag($i)
    {
        unset($this->tags[$i]);
        $this->tags = array_values($this->tags); // Reindex the array
    }

    public function save()
    {
        $this->js('window.dispatchEvent(escKey)'); 
        $this->js('notyf.success("dummy saved")');
    }
}
