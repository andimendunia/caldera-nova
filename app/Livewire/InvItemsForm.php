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
    public $quoms = [];
    // public $qty_main;
    // public $qty_used;
    // public $qty_rep;
    public $qty_main_min = 0;
    public $qty_main_max = 0;
    public $denom = 1;
    public $up = 0;
    public $photo;
    public $is_active;

    public function rules()
    {
        return [
            'name'      => ['required','min:1', 'max:128'],
            'desc'      => ['required', 'min:1', 'max:256'],
            'code'      => ['nullable', 'size:11'],
            'curr_id'   => ['nullable', 'integer'],
            'price'     => ['required', 'numeric', 'min:0', 'max:999000000'],
            'price_sec' => ['required', 'numeric', 'min:0', 'max:999000000'],
            'uom'       => ['required', 'min:1', 'max:5'],
            'denom'     => ['required', 'integer', 'min:1', 'max:1000'],
            'loc'       => ['nullable', 'alpha_dash', 'max:20'],
            'tags.*'    => ['nullable', 'alpha_dash', 'max:20'],
            'qty_main_min'  => ['required', 'integer', 'min:0', 'max:99999'],
            'qty_main_max'  => ['required', 'integer', 'min:0', 'max:99999'],
        ];
    }


    public function mount()
    {
        $item = InvItem::find($this->id);
        $area = InvArea::find($this->area_id);
        $this->curr_main = InvCurr::find(1);
        $mode = '';

        // fill global inventory param
        $this->currs = InvCurr::where('id', '<>', 1)->get(); 
        $this->quoms = InvUom::orderBy('name')->get()->pluck('name')->toArray(); 

        if ($item) {
            // edit mode fill all properties
            $mode = 'edit';

        } elseif ($area) {
            // create mode needs area_id (required) and code (optional)
            $mode = 'create';
            // example
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
        $rate   = (double)($this->curr_sec->rate ?? 0);
        $price  = (double)$this->price;
        $this->price_sec = round(($rate > 0 ? ($price * $rate) : 0), 2);
    }

    public function updatedPriceSec()
    {
        $rate       = (double)$this->curr_sec->rate ?? 0;
        $price_sec  = (double)$this->price_sec;
        $this->price = round(($rate > 0 ? ($price_sec / $rate) : 0), 2);
        $this->calcUp();
    }

    #[On('loc-applied')] 
    public function updatLoc($loc)
    {
        $this->loc = $loc;
    }

    #[On('tags-applied')] 
    public function updateTags($tags)
    {
        $this->tags = $tags;
    }

    public function calcUp()
    {
        $price = (double)$this->price;
        $denom = (int)$this->denom;
        $uom = $this->uom;

        $this->up = round((($price && $denom > 1 && $uom) ? ($price / $denom) : 0), 2);
    }

    public function updated($property)
    {
        if ($property == 'price' || $property == 'denom' || $property == 'uom') {
            $this->calcUp();
        } 
    }

    public function save()
    {

        // validate if photo url exist

        $curr       = InvCurr::find((int)$this->curr_id);
        $rate       = (double)($curr ? $curr->rate : 1);
        $price      = (double)$this->price;
        $price_sec  = (double)$this->price_sec;
        $denom      = (int)$this->denom;

        if($curr && $price_sec && $rate > 0) {
            $this->price     = $price_sec / $rate;
        } else {
            $this->curr_id   = '';
            $this->price     = $price;
        }

        $this->price_sec = $price_sec; 
        $this->qty_main_min   = (int)$this->qty_main_min;
        $this->qty_main_max   = (int)$this->qty_main_max;
        $this->denom = $denom > 0 ? $denom : 1;

        $props = ['name', 'desc', 'code', 'uom', 'loc'];
        foreach($props as $prop) {
            $this->$prop = trim($this->$prop);
        }
        
        $this->tags = array_map('trim', $this->tags);
        
        $propUps = ['uom', 'loc'];
        foreach ($propUps as $propUp) {
            $this->$propUp = strtoupper($this->$propUp);
        }

        $this->tags = array_map('strtolower', $this->tags);

        $validated = $this->validate();
        dd($validated);

    }

}
