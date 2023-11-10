<?php

namespace App\Livewire;

use App\Models\ComItem;
use Livewire\Component;
use Livewire\Attributes\On;

class Comments extends Component
{
    public $mod;

    public $name;
    public $id;

    public function mount()
    {
        $this->name = class_basename($this->mod);
        $this->id = $this->mod->id;
    }
    
    
    #[On('comment-added')]
    public function render()
    {
        $comments = ComItem::orderByDesc('updated_at')->where('mod', $this->name)->where('mod_id', $this->id)->get();
        return view('livewire.comments', compact('comments'));
    }

}
