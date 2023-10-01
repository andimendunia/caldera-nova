<?php

namespace App\Livewire;

use App\Models\InvUom;
use Livewire\Component;
use Illuminate\Validation\Rule;

class InvUomsEdit extends Component
{
    public InvUom $uom;

    public $name = '';

    public function rules()
    {
        return [
            'name' => ['required', 'min:1', 'max:3',Rule::unique('inv_uoms')->ignore($this->uom->id)]
        ];
    }

    public function placeholder()
    {
        return view('livewire.modal-placeholder');
    }

    public function mount(InvUom $uom)
    {
        $this->fill(
            $uom->only('name')
        );
    }

    public function render()
    {
        return view('livewire.inv-uoms-edit');
    }

    public function update()
    {
        $this->name = strtoupper($this->name);
        $validated = $this->validate();

        $uom = InvUom::find($this->uom->id);
        if ($uom) {
            $uom->update($validated); 
            $this->js('window.dispatchEvent(escKey)'); 
            $this->js('notyf.success("'.__('UOM diperbarui').'")'); 
            $this->dispatch('updated');
        }
    }

    public function delete()
    {
        // update: potential bug. Delete only when there is no inv_items using it

        $uom = InvUom::find($this->uom->id);
        if ($uom) {
            $uom->delete();
            $this->js('window.dispatchEvent(escKey)'); 
            $this->js('notyf.success("'.__('UOM dihapus').'")'); 
            $this->dispatch('updated');
        }

    }
}
