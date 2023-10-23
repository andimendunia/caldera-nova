<?php

namespace App\Livewire;

use App\Models\InvCurr;
use App\Models\InvItem;
use Livewire\Component;
use Livewire\Attributes\On;

class InvItemShow extends Component
{
    public InvItem $inv_item;
    public InvCurr $inv_curr;

    public function mount()
    {
        $this->inv_curr = InvCurr::find(1);
    }

    #[On('updated')] 
    public function render()
    {
        $loc = $this->inv_item->loc();
        $tags = $this->inv_item->tags();
        return view('livewire.inv-item-show', compact('loc', 'tags'));
    }
}
