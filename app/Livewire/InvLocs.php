<?php

namespace App\Livewire;

use App\Models\InvLoc;
use App\Models\InvArea;
use Livewire\Component;
use Livewire\Attributes\On;
use Livewire\Attributes\Url;
use Livewire\WithPagination;

class InvLocs extends Component
{
    use WithPagination;
    
    public $areas;

    #[Url] 
    public $area_id = '';

    #[Url] 
    public $q = '';

    public $perPage = 24;

    #[On('updated')]
    public function render()
    {
        $locs = InvLoc::where('inv_area_id', $this->area_id)
        ->where('name', 'LIKE', '%'.$this->q.'%')
        ->orderBy('name')
        ->paginate($this->perPage);

        $this->areas = InvArea::all();
        return view('livewire.inv-locs', compact('locs'));
    }

    public function updating($property)
    {
        if($property == 'area_id' || $property == 'q')
        {
            $this->reset('perPage');
        }

    }

    public function loadMore()
    {
        $this->perPage += 24;
    }
}
