<?php

namespace App\Livewire;

use App\Models\InvLoc;
use App\Models\InvArea;
use App\Models\InvCurr;
use App\Models\InvItem;
use Livewire\Component;
use Livewire\Attributes\Url;

class InvItemsForm extends Component
{
    public $curr_main;
    public $curr_sec;
    public $currs;


    public $qlocs = [];
    public $qtags = [];

    #[Url] 
    public $id;

    public $name;
    public $desc;

    #[Url] 
    public $code;
    public $price = 0;
    public $price_sec = 0;
    public $inv_curr_id;
    public $uom;
    public $loc;

    #[Url] 
    public $inv_area_id;

    public $qty_main;
    public $qty_used;
    public $qty_rep;
    public $qty_main_min;
    public $qty_main_max;
    public $photo;
    public $is_active;
    public $tags;

    public function mount()
    {
        $item = InvItem::find($this->id);
        $area = InvArea::find($this->inv_area_id);
        $this->curr_main = InvCurr::find(1);
        $mode = '';

        if ($item) {
            // edit mode fill all properties
            $mode = 'edit';
        } elseif ($area) {
            // create mode needs area_id (required) and code (optional)
            $this->currs = InvCurr::where('id', '<>', 1)->get(); 
            $mode = 'create';
        } 

        if (!$mode) {
            return abort('403', __('Parameter tidak sah'));
        }
        
    }

    public function render()
    {
        return view('livewire.inv-items-form');
    }

    public function updatedInvCurrId()
    {
        $this->curr_sec = InvCurr::find($this->inv_curr_id);
        $this->updatedPrice();
    }

    public function updatedPrice()
    {
        $rate = $this->curr_sec->rate ?? 0;
        $this->price_sec = $rate ? round(((double)$this->price * (double)$rate), 2) : 0;
    }

    public function updatedPriceSec()
    {
        $rate = $this->curr_sec->rate ?? 0;
        $this->price = $rate ? round(((double)$this->price_sec / (double)$rate), 2) : 0;
    }

    public function updatedLoc()
    {
        $loc = trim($this->loc);
        $this->qlocs = $loc 
        ? InvLoc::where('inv_area_id', $this->inv_area_id)
        ->where('name', 'LIKE', '%'.$loc.'%')->orderBy('name')->take(100)->get()
        ->pluck('name')->toArray()
        : [];
    }
}
