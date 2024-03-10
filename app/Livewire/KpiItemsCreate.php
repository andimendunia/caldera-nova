<?php

namespace App\Livewire;

use App\Models\KpiItem;
use Livewire\Component;
use Livewire\Attributes\On;
use Livewire\Attributes\Rule;
use Livewire\Attributes\Reactive;

class KpiItemsCreate extends Component
{
    #[Reactive]
    #[Rule('required|exists:App\Models\KpiArea,id')]
    public $area_id;

    #[Reactive]
    public $area_name;

    #[Rule('required|integer|min:1970|max:9999')]
    public $item_year;

    #[Rule('required|min:1|max:256')]
    public $item_name = '';

    #[Rule('required|min:1|max:20')]
    public $item_unit = '';

    #[Rule('nullable|min:1|max:20')]
    public $item_group = '';

    #[Rule('nullable|min:1|max:100')]
    public $item_order = '';

    public function placeholder()
    {
        return view('livewire.modal-placeholder');
    }

    public function render()
    {
        return view('livewire.kpi-items-create');
    }

    #[On('year-updated')] 
    public function updateItemYear($year)
    {
        $this->item_year = $year;
    }

    public function save()
    {
        $validated = $this->validate();

        $unit = strtoupper(trim($this->item_unit));
        $group = strtoupper(trim($this->item_group));

        KpiItem::create([
            'kpi_area_id' => $this->area_id,
            'year'        => $this->item_year,
            'name'        => trim($this->item_name),
            'unit'        => $unit,
            'group'       => $group ? $group : null,
            'order'       => (int) $this->item_order
        ]);
        
        $this->reset(['item_name', 'item_unit']);
        $this->js('window.dispatchEvent(escKey)'); 
        $this->js('notyf.success("'.__('Item KPI dibuat').'")'); 
        $this->dispatch('updated');
        $this->dispatch('set-year', year:$this->item_year);
    }
}
