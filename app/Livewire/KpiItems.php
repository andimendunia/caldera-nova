<?php

namespace App\Livewire;

use App\Models\KpiArea;
use App\Models\KpiItem;
use Livewire\Component;
use Livewire\Attributes\On;
use Livewire\Attributes\Url;

class KpiItems extends Component
{
    #[Url]
    public $area_id;
    public $area_name;
    public $areas;

    #[Url]
    public $f_year;
    public $years;

    public function mount()
    {
        $this->getYears();
        $this->areas = KpiArea::all();
    }

    #[On('updated')]
    public function render()
    {
        $builder = KpiItem::where('kpi_area_id', $this->area_id)
            ->where('year', $this->f_year)
            ->orderBy('group', 'ASC')
            ->orderBy('order', 'ASC');
        $grouped_items = $builder->get()->groupBy('group');
        $item_ids = $grouped_items
            ->flatMap(function ($item) {
                return $item->pluck('id');
            })
            ->sort();

        return view('livewire.kpi-items', compact('grouped_items', 'item_ids'));
    }

    public function updated($property)
    {
        if ($property === 'area_id') {
            $area = KpiArea::find($this->area_id);
            $area ? ($this->area_name = $area->name) : $this->reset(['area_name']);
            $this->getYears();
            $this->reset(['f_year']);
        }

        if ($property === 'f_year') {
            $this->dispatch('year-updated', year: $this->f_year);
        }
    }
    public function getYears()
    {
        $this->years = KpiItem::orderBy('year', 'DESC')
            ->select('year')
            ->where('kpi_area_id', $this->area_id)
            ->distinct()
            ->pluck('year');
    }

    #[On('set-year')]
    public function setYear($year)
    {
        $this->getYears();
        $this->f_year = $year;
    }
}
