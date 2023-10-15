<?php

namespace App\Livewire;

use App\Models\InvLoc;
use Livewire\Component;

class InvItemLoc extends Component
{
    public $area_id;

    public $loc;
    public $qlocs = [];

    public function render()
    {
        return view('livewire.inv-item-loc');
    }

    public function updatedLoc()
    {
        $qloc = '%'.$this->loc.'%';
        $qlocs = InvLoc::where('inv_area_id', $this->area_id)
        ->where('name', 'LIKE', $qloc)
        ->orderBy('name')
        ->take(100)
        ->get()
        ->pluck('name');
        $this->qlocs = $qlocs->toArray();
    }
}
