<?php

namespace App\Livewire;

use App\Models\InvArea;
use App\Models\InvItem;
use Livewire\Component;
use Illuminate\Validation\Rule;

class InvAreasEdit extends Component
{
    public InvArea $area;
    
    public $name = '';

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
        $count = InvItem::where('inv_area_id', $this->area->id)->count();
        $area = InvArea::find($this->area->id);

        if ($area) {
            if ($count > 0)
            {
                $this->js('window.dispatchEvent(escKey)'); 
                $this->js('notyf.error("' . '\"' . $area->name . '\" ' . __('berisi barang') . '")'); 

            } else {
                        $area->delete();
                $this->js('window.dispatchEvent(escKey)'); 
                $this->js('notyf.success("'.__('Area dihapus').'")'); 
                $this->dispatch('updated');
            }

        }

    }
}
