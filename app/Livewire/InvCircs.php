<?php

namespace App\Livewire;

use App\Models\InvArea;
use App\Models\InvCirc;
use App\Models\InvCurr;
use Livewire\Component;
use Livewire\Attributes\Url;

class InvCircs extends Component
{
    #[Url]
    public $q;
    #[Url]
    public $status = [];
    #[Url]
    public $user;
    #[Url]
    public $directions = [];
    #[Url]
    public $date_start;
    #[Url]
    public $date_end;
    #[Url]
    public $area_ids = [];

    public $areas;
    public $curr;

    public function mount()
    {
        $this->areas = InvArea::all();
        $this->curr = InvCurr::find(1);
    }


    public function render()
    {
        $circs = InvCirc::all();

        return view('livewire.inv-circs', compact('circs'));
    }
}
