<?php

namespace App\Livewire;

use App\Models\InvTag;
use Livewire\Component;

class InvItemTags extends Component
{
    public $inv_area_id;
    public $tags = [];
    public $qtags = [];

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
        $this->dispatch('tags-applied', tags: $this->tags);
    }

    // public function apply()
    // {
    //     $this->js('window.dispatchEvent(escKey)'); 
    // }

    public function updatedTags($value, $index)
    {
        $tag = '%'.$value.'%';
        $qtags = InvTag::where('inv_area_id', $this->inv_area_id)
        ->where('name', 'LIKE', $tag)
        ->orderBy('name')
        ->take(100)
        ->get()
        ->pluck('name');
        $this->qtags[$index] = $qtags->toArray();
        $this->dispatch('tags-applied', tags: $this->tags);

    }
}
