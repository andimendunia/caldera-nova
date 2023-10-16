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
    public $price;
    public $price_sec;
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
    public $qty_main_min;
    public $qty_main_max;
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
            'price'     => ['nullable', 'numeric', 'min:0', 'max:999000000'],
            'price_sec' => ['nullable', 'numeric', 'min:0', 'max:999000000'],
            'loc'       => ['nullable', 'alpha_dash', 'max:20'],
            'tags.*'    => ['nullable', 'alpha_dash', 'max:20'],
            // 'qty_main'  => ['nullable', 'integer', 'min:0', 'max:99999'],
            // 'qty_used'  => ['nullable', 'integer', 'min:0', 'max:99999'],
            // 'qty_rep'   => ['nullable', 'integer', 'min:0', 'max:99999'],
            'uom'       => ['required', 'min:1', 'max:5'],
            'denom'     => ['nullable', 'integer', 'min:1', 'max:1000'],
            'qty_main_min'  => ['nullable', 'integer', 'min:0', 'max:99999'],
            'qty_main_max'  => ['nullable', 'integer', 'min:0', 'max:99999'],
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
        $rate = $this->curr_sec->rate ?? 0;
        $this->price_sec = $rate ? round(((double)$this->price * (double)$rate), 2) : 0;
    }

    public function updatedPriceSec()
    {
        $rate = $this->curr_sec->rate ?? 0;
        $this->price = $rate ? round(((double)$this->price_sec / (double)$rate), 2) : 0;
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

        if ($price > 0 && $denom > 1 && $uom) {
            $this->up = round(($price / $denom), 2);
        } else {
            $this->up = 0;
        }
    }

    public function updated($property)
    {
        if ($property == 'price' || $property == 'denom' || $property == 'uom') {
            $this->calcUp();
        } 
    }

    public function save()
    {
        $validated = $this->validate();
        dd($validated);

    }

}
