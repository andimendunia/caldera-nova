<?php

namespace App\Livewire;

use App\Models\KpiItem;
use Livewire\Component;
use Livewire\Attributes\Rule;
use Livewire\Attributes\Reactive;

class KpiItemsCreate extends Component
{
    #[Reactive]
    #[Rule('required|exists:App\Models\KpiArea,id')]
    public $area_id = '';

    #[Reactive]
    public $area_name = '';

    #[Reactive]
    #[Rule('required|integer|min:1970|max:9999')]
    public $item_year = '';

    #[Rule('required|min:1|max:256')]
    public $item_name = '';

    #[Rule('required|min:1|max:20')]
    public $item_unit = '';

    public function placeholder()
    {
        return view('livewire.modal-placeholder');
    }

    public function render()
    {
        return view('livewire.kpi-items-create');
    }

    public function save()
    {
        $validated = $this->validate();

        KpiItem::create([
            'kpi_area_id' => $this->area_id,
            'year'        => $this->item_year,
            'name'        => $this->item_name,
            'unit'        => $this->item_unit,
        ]);
        
        $this->reset(['name']);
        $this->js('window.dispatchEvent(escKey)'); 
        $this->js('notyf.success("'.__('Item KPI dibuat').'")'); 
        $this->dispatch('updated');

    }
}
