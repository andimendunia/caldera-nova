<?php

namespace App\Livewire;

use App\Models\InvTag;
use Livewire\Component;

class InvItemTags extends Component
{
    public $area_id;
    public $tags = [];
    public $qtags = [];

    public function rules()
    {

        return [
            'tags.*' => [ 'required', 'alpha_dash', 'min:1', 'max:20' ]
        ];
    }

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
        $this->validate();
        $this->dispatch('tags-saved', tags: $this->tags);
        $this->js('window.dispatchEvent(escKey)'); 
        $this->js('notyf.success("Debug: saved")');
    }

    public function updatedTags($value, $index)
    {
        $tag = '%'.$value.'%';
        $qtags = InvTag::where('inv_area_id', $this->area_id)
        ->where('name', 'LIKE', $tag)
        ->orderBy('name')
        ->take(100)
        ->get()
        ->pluck('name');
        $this->qtags[$index] = $qtags->toArray();

    }
}
