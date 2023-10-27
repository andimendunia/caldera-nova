<?php

namespace App\Livewire;

use App\Models\InvTag;
use Livewire\Component;
use Illuminate\Validation\Rule;
use Illuminate\Database\Query\Builder;

class InvTagsEdit extends Component
{
    public InvTag $tag;

    public $name = '';

    public function rules()
    {

        return [
            'name' => [
                'required', 'alpha_dash', 'min:1', 'max:20',
                Rule::unique('inv_tags')->where(fn (Builder $q) => $q->where('name', $this->name)->where('inv_area_id', $this->tag->inv_area_id))->ignore($this->tag->id)],
        ];
    }

    public function placeholder()
    {
        return view('livewire.modal-placeholder');
    }

    public function mount(InvTag $tag)
    {
        $this->fill(
            $tag->only('name')
        );
    }

    public function render()
    {
        return view('livewire.inv-tags-edit');
    }

    public function update()
    {
        $this->name = strtolower($this->name);
        $validated = $this->validate();
        
        $tag = InvTag::find($this->tag->id);
        if ($tag) {
            $tag->update($validated);
            $this->js('window.dispatchEvent(escKey)'); 
            $this->js('notyf.success("'.__('Tag diperbarui').'")'); 
            $this->dispatch('updated');
        }
    }

    public function delete()
    {
        // update: potential bug. Delete only when there is no inv_items using it

        $tag = InvTag::find($this->tag->id);
        if ($tag) {
            $tag->delete();
            $this->js('window.dispatchEvent(escKey)'); 
            $this->js('notyf.success("'.__('Tag dihapus').'")'); 
            $this->dispatch('updated');
        }
        
    }
}
