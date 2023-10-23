<?php

namespace App\Livewire;

use App\Models\InvTag;
use App\Models\InvItem;
use Livewire\Component;
use Livewire\Attributes\On;
use Illuminate\Support\Facades\Validator;

class InvItemTags extends Component
{
    public $inv_area_id;

    public $isForm = false;

    public $id;
    public $tags = [];
    public $qtags = [];

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
            $validator = Validator::make($this->tags,
                ['*' => 'alpha_dash|min:1|max:20'],
                ['*.alpha_dash' => __('Hanya boleh mengandung huruf, angka, dan strip'), '*.max' => __('Maksimal 20 karakter')]
            );

            if ($validator->fails()) {

                $errors = $validator->errors();
                $error = $errors->first();
                $this->js('notyf.error("'.$error.'")'); 

            } else {
                $item = InvItem::find($this->id);
                if($item) {
                    if ($item->tags_array() !== $this->tags) {
                        $item->updateTags($this->tags);
                        $this->js('notyf.success("'.__('Tag diperbarui').'")');
                        $this->dispatch('updated');
                    }
                }
            }

        }

    }
}
