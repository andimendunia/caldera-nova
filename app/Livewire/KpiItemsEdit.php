<?php

namespace App\Livewire;

use App\Models\KpiItem;
use Livewire\Component;
use Illuminate\Validation\Rule;

class KpiItemsEdit extends Component
{
    public KpiItem $item;

    public $area_name;
    public $year;

    public $name = '';
    public $unit = '';


    public function rules()
    {
        return [
            'name' => ['required', 'min:1', 'max:256'],
            'unit' => ['required', 'min:1', 'max:20']
        ];
    }

    public function placeholder()
    {
        return view('livewire.modal-placeholder');
    }

    public function mount(KpiItem $item)
    {
        $this->fill(
            $item->only(['year', 'name', 'unit'])
        );

        $this->area_name = $item->kpi_area->name;
    }
        

    public function render()
    {
        return view('livewire.kpi-items-edit');
    }

    public function update()
    {
        $validated = $this->validate();

        $item = KpiItem::find($this->item->id);
        if ($item) {
            $item->update($validated); 
            $this->js('window.dispatchEvent(escKey)'); 
            $this->js('notyf.success("'.__('Item KPI diperbarui').'")'); 
            $this->dispatch('updated');
        }
    }

    public function delete()
    {
        // update: potential bug. Delete only when there is no inv_items using it

        $item = KpiItem::find($this->item->id);
        if ($item) {
            $item->delete();
            $this->js('window.dispatchEvent(escKey)'); 
            $this->js('notyf.success("'.__('Item KPI dihapus').'")'); 
            $this->dispatch('updated');
        }

    }
}
