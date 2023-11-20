<?php

namespace App\Livewire;

use App\Models\InvTag;
use App\Models\InvItem;
use Livewire\Component;
use Livewire\Attributes\On;

class InvItemTags extends Component
{
    public $inv_area_id;

    public $isForm = false;

    public $id;
    public $tags = [];
    public $qtags = [];

    public function rules()
    {
        return [
            'tags.*' => ['nullable', 'alpha_dash', 'max:20'],
        ];
    }

    public function messages() 
    {
        return [
            'tags.*.alpha_dash' => __('Hanya huruf, angka, dan strip'),
            'tags.*.max' => __('Maksimal 20 karakter'),
        ];
    }
    

    public function placeholder()
    {
        return view('livewire.modal-placeholder');
    }

    #[On('updated')]
    public function mount()
    {
        $item = InvItem::find($this->id);
        if($item) {
            $this->tags = $item->tags_array();
        }
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
    }

    public function apply()
    {
        if ($this->isForm) {
            $this->dispatch('tags-applied', tags: $this->tags);
        } else {
            $this->validate();
            $item = InvItem::find($this->id);
            if($item) {
                $item->updateTags($this->tags);
                $this->js('window.dispatchEvent(escKey)'); 
                $this->js('notyf.success("'.__('Tag diperbarui').'")');
                $this->dispatch('updated');
            }

        }

    }
}
