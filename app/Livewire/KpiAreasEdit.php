<?php

namespace App\Livewire;

use App\Models\KpiArea;
use Livewire\Component;
use Illuminate\Validation\Rule;

class KpiAreasEdit extends Component
{
    public KpiArea $area;
    
    public $name = '';

    public function rules()
    {
        return [
            'name' => ['required', 'min:1', 'max:20', Rule::unique('kpi_areas')->ignore($this->area->id)],
        ];
    }

    public function placeholder()
    {
        return view('livewire.modal-placeholder');
    }

    public function mount(KpiArea $area)
    {
        $this->fill(
            $area->only('name')
        );
    }

    public function render()
    {
        return view('livewire.kpi-areas-edit');
    }

    public function update()
    {
        $validated = $this->validate();

        $area = KpiArea::find($this->area->id);
        if ($area) {
            $area->update($validated); 
            $this->js('window.dispatchEvent(escKey)'); 
            $this->js('notyf.success("'.__('Area diperbarui').'")'); 
            $this->dispatch('updated');
        }
    }

    public function delete()
    {
        // update: potential bug. Delete only when there is no kpi_items using it

        $area = KpiArea::find($this->area->id);
        if ($area) {
            $area->delete();
            $this->js('window.dispatchEvent(escKey)'); 
            $this->js('notyf.success("'.__('Area dihapus').'")'); 
            $this->dispatch('updated');
        }

    }
}
