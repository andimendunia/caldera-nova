<?php

namespace App\Livewire;

use App\Models\InvArea;
use App\Models\InvCurr;
use App\Models\InvItem;
use App\Models\InvUom;
use Livewire\Component;
use Livewire\Attributes\On;
use Livewire\Attributes\Url;

class InvItemsForm extends Component
{
    public $curr_main;
    public $curr_sec;
    public $currs;

    #[Url] 
    public $id;
    public $name;
    public $desc;

    #[Url] 
    public $code;
    public $price = 0;
    public $price_sec = 0;
    public $curr_id;
    public $loc;
    public $tags = [];

    #[Url] 
    public $area_id;
    public $uom;
    public $uoms = [];
    public $qty_main;
    public $qty_used;
    public $qty_rep;
    public $qty_main_min;
    public $qty_main_max;
    public $photo;
    public $is_active;


    public function mount()
    {
        $item = InvItem::find($this->id);
        $area = InvArea::find($this->area_id);
        $this->curr_main = InvCurr::find(1);
        $mode = '';

        if ($item) {
            // edit mode fill all properties
            $mode = 'edit';

        } elseif ($area) {
            // create mode needs area_id (required) and code (optional)
            $mode = 'create';
            $this->currs = InvCurr::where('id', '<>', 1)->get(); 
            $this->uoms = InvUom::where('inv_area_id', $area->id)->get(); 
            $this->tags = ['smack', 'my', 'ass'];

        } 

        if (!$mode) {
            return abort('403', __('Parameter tidak sah'));
        }
        
    }

    public function render()
    {
        return view('livewire.inv-items-form');
    }

    public function updatedCurrId()
    {
        $this->curr_sec = InvCurr::find($this->curr_id);
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

    #[On('tags-saved')] 
    public function updateTags($tags)
    {
        $this->tags = $tags;
    }

    public function checkTags()
    {
        dd($this->tags);
    }
}
