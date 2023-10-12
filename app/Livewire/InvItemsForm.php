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
        $mode = '';

        if ($item) {
            // edit mode fill all properties
            $mode = 'edit';
        } elseif ($area) {
            // create mode needs area_id (required) and code (optional)
            $mode = 'create';
        } 

        if (!$mode) {
            return abort('403', __('Parameter tidak sah'));
        }
        
    }

    public function render()
    {
        $this->curr_main = InvCurr::find(1)->name;
        $this->currs = InvCurr::where('id', '<>', 1)->get();  
        if ($this->inv_curr_id) {
            $curr_sec = InvCurr::find($this->inv_curr_id);
            if ($curr_sec) {
                $this->curr_sec = $curr_sec->name;
            }
        }
        return view('livewire.inv-items-form');
    }

    public function updated($property)
    {
        if($property == 'loc') {
            if($this->loc) {
                $loc = '%'.$this->loc.'%';
                $this->qlocs = InvLoc::where('inv_area_id', $this->inv_area_id)->where('name', 'LIKE', $loc)->orderBy('name')->take(100)->get();
            } else {
                $this->reset('qlocs');
            }
        }

        if($property == 'price' || $property == 'price_sec' || $property = 'inv_curr_id')
        {
            if($this->inv_curr_id) 
            {
                $curr = InvCurr::find($this->inv_curr_id);
                if ($curr) {
                    if ($property == 'price') {
                        $this->price_sec = round(($this->price * $curr->rate), 2);
                    } elseif ($property == 'price_sec') {
                        $this->price = round(($this->price_sec / $curr->rate), 2);
                    } elseif ($property == 'inv_curr_id') {
                        $this->price_sec = round(($this->price * $curr->rate), 2);
                    }
                }
            }
        } 
    }
}
