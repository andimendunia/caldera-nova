<?php

namespace App\Livewire;

use App\Models\KpiArea;
use App\Models\KpiItem;
use Livewire\Component;

class KpiItems extends Component
{
    public $areas;
    public $area_id;
    public $area_name;

    public $years;
    public $item_year;

    public $items = [];

    public function mount()
    {
        $this->getYears();
        $this->areas = KpiArea::all();
    }
    
    public function render()
    {
        return view('livewire.kpi-items');
    }

    public function updated($property)
    {
        // $property: The name of the current property that was updated
 
        if ($property === 'area_id') {
            $area = KpiArea::find($this->area_id);
            $area ? $this->area_name = $area->name : $this->reset(['area_name']);
        }
    }

    public function getYears()
    {
        $this->years = KpiItem::select('year')->distinct()->pluck('year');
    }
}
