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
    public $f_year;

    public $perPage = 24;

    public function mount()
    {
        $this->getYears();
        $this->areas = KpiArea::all();
    }
    
    public function render()
    {
        $kpi_items = KpiItem::where('kpi_area_id', $this->area_id)->where('year', $this->f_year)->paginate($this->perPage);

        return view('livewire.kpi-items', compact('kpi_items'));
    }

    public function updated($property)
    {
        if ($property === 'area_id') {
            $area = KpiArea::find($this->area_id);
            $area ? $this->area_name = $area->name : $this->reset(['area_name']);
            $this->getYears();
        }

        if ($property === 'f_year') {
            $this->dispatch('year-updated', year: $this->f_year);
        }
    }

    public function getYears()
    {
        $this->years = KpiItem::select('year')->where('kpi_area_id', $this->area_id)->distinct()->pluck('year');
    }
}
