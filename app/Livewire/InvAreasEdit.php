<?php

namespace App\Livewire;

use App\Models\InvArea;
use Livewire\Component;
use Illuminate\Validation\Rule;

class InvAreasEdit extends Component
{
    public InvArea $area;
    
    public $name = '';
    public $rate = '';

    public function rules()
    {
        return [
            'name' => ['required', 'min:1', 'max:20', Rule::unique('inv_areas')->ignore($this->area->id)],
        ];
    }

    public function placeholder()
    {
        return view('livewire.modal-placeholder');
    }

    public function mount(InvArea $area)
    {
        $this->fill(
            $area->only('name')
        );
    }

    public function render()
    {
        return view('livewire.inv-areas-edit');
    }

    public function update()
    {
        $validated = $this->validate();

        $area = InvArea::find($this->area->id);
        if ($area) {
            $area->update($validated); 
            $this->js('window.dispatchEvent(escKey)'); 
            $this->js('notyf.success("'.__('Area diperbarui').'")'); 
            $this->dispatch('updated');
        }
    }

    public function delete()
    {
        // update: potential bug. Delete only when there is no inv_items using it

        $area = InvArea::find($this->area->id);
        if ($area) {
            $area->delete();
            $this->js('window.dispatchEvent(escKey)'); 
            $this->js('notyf.success("'.__('Area dihapus').'")'); 
            $this->dispatch('updated');
        }

    }
}
