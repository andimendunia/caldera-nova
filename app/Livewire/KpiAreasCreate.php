<?php

namespace App\Livewire;

use App\Models\KpiArea;
use Livewire\Component;
use Livewire\Attributes\Rule;

class KpiAreasCreate extends Component
{
    #[Rule('required|min:1|max:20|unique:kpi_areas,name')]
    public $name = '';

    public function placeholder()
    {
        return view('livewire.modal-placeholder');
    }

    public function render()
    {
        return view('livewire.kpi-areas-create');
    }

    public function save()
    {
        $validated = $this->validate();

        KpiArea::create($validated);
        $this->reset(['name']);
        $this->js('window.dispatchEvent(escKey)'); 
        $this->js('notyf.success("'.__('Area KPI dibuat').'")'); 
        $this->dispatch('updated');

    }
}
