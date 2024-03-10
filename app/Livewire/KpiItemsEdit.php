<?php

namespace App\Livewire;

use App\Models\KpiItem;
use Livewire\Component;
use Illuminate\Validation\Rule;

class KpiItemsEdit extends Component
{
    public $item_id;
    public $item;

    public $area_name;
    public $year;

    public $name    = '';
    public $unit    = '';
    public $group   = '';
    public $order   = 0;


    public function rules()
    {
        return [
            'name' => ['required', 'min:1', 'max:256'],
            'unit' => ['required', 'min:1', 'max:20'],
            'group' => ['nullable', 'min:1', 'max:20'],
            'order' => ['nullable', 'min:1', 'max:100']
        ];
    }

    public function placeholder()
    {
        return view('livewire.modal-placeholder');
    }

    public function mount()
    {
        $this->item = KpiItem::find($this->item_id);
        $this->fill(
            $this->item->only(['year', 'name', 'unit', 'group', 'order'])
        );

        $this->area_name = $this->item->kpi_area->name;
    }
        

    public function render()
    {
        return view('livewire.kpi-items-edit');
    }

    public function update()
    {
        $validated = $this->validate();

        $unit = strtoupper(trim($this->unit));
        $group = strtoupper(trim($this->group));

        $item = KpiItem::find($this->item->id);
        if ($item) {
            $item->update([
                'name'  => trim($this->name),
                'unit'  => $unit,
                'group' => $group ? $group : null,
                'order' => (int) $this->order                
            ]); 
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
