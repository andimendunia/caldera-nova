<?php

namespace App\Livewire;

use App\Models\InvUom;
use App\Models\InvArea;
use App\Models\InvCurr;
use App\Models\InvItem;
use Livewire\Component;
use Livewire\Attributes\On;
use Livewire\Attributes\Url;
use Illuminate\Validation\Rule;
use Livewire\Attributes\Renderless;
use Illuminate\Support\Facades\Gate;
use Illuminate\Database\Query\Builder;

class InvForm extends Component
{

    public $curr_main;
    public $curr_sec;
    public $currs;

    public InvItem $inv_item;

    public $id;
    public $name;
    public $desc;

    #[Url] 
    public $code;
    public $price = 0;
    public $price_sec = 0;

    public $loc;
    public $tags = [];
    public $uom;
    public $quoms = [];
    public $qty_main_min = 0;
    public $qty_main_max = 0;
    public $denom = 1;
    public $up = 0;
    public $photo;
    public $url;
    public $is_active;

    #[Url] 
    public $inv_area_id;
    public $inv_curr_id;

    public function rules()
    {
        return [
            'name'          => ['required','min:1', 'max:128'],
            'desc'          => ['required', 'min:1', 'max:256'],
            'code'          => ['nullable', 'alpha_dash', 'size:11', Rule::unique('inv_items')->where(fn (Builder $q) => $q->where('code', $this->code)->where('inv_area_id', $this->inv_area_id))->ignore($this->inv_item->id ?? '')],
            'price'         => ['required', 'numeric', 'min:0', 'max:999000000'],
            'price_sec'     => ['required', 'numeric', 'min:0', 'max:999000000'],
            'uom'           => ['required', 'min:1', 'max:5'],
            'denom'         => ['required', 'integer', 'min:1', 'max:1000'],
            'loc'           => ['nullable', 'alpha_dash', 'max:20'],
            'tags.*'        => ['nullable', 'alpha_dash', 'max:20'],
            'qty_main_min'  => ['required', 'integer', 'min:0', 'max:99999'],
            'qty_main_max'  => ['required', 'integer', 'min:0', 'max:99999'],
            'is_active'     => ['required', 'boolean'],

            'inv_curr_id'   => ['nullable', 'integer', 'exists:App\Models\InvCurr,id'],
            'inv_area_id'   => ['required', 'integer', 'exists:App\Models\InvArea,id'],
        ];
    }

    public function messages()
    {
        return [
            'tags.*.alpha_dash' => __('Tag hanya boleh berisi huruf, angka, dan strip')
        ];
    }


    public function mount(InvItem $inv_item)
    {
        $area = InvArea::find($this->inv_area_id);
        $mode = '';

        if ($inv_item->id) {
            // edit mode fill all properties
            $mode = 'edit';
            $this->fill(
                $inv_item->only('name', 'desc', 'code', 'price', 'inv_area_id', 'inv_curr_id', 'price_sec', 'denom', 'qty_main_min', 'qty_main_max', 'photo', 'is_active')
            );
            //fill uom, loc, tags and up
            $this->uom = $inv_item->inv_uom->name ?? '';
            $this->loc = $inv_item->inv_loc->name ?? '';
            $this->tags = $inv_item->tags_array();
            $this->url = '/storage/inv-items/'.$inv_item->photo;
            $this->curr_sec = InvCurr::find($this->inv_curr_id);
            $this->up = $inv_item->denom() > 1 ? $inv_item->price() : 0;

        } elseif ($area) {
            // create mode needs area_id (required) and inv_code (optional)
            $mode = 'create';
        } 

        if (!$mode) {
            return abort('403', __('Parameter tidak sah'));
        }

        // fill global inventory param
        $this->currs = InvCurr::where('id', '<>', 1)->get(); 
        $this->quoms = InvUom::orderBy('name')->get()->pluck('name')->toArray(); 
        $this->curr_main = InvCurr::find(1);
        
    }

    public function render()
    {
        return view('livewire.inv-form');
    }

    public function updatedInvCurrId()
    {
        $this->curr_sec = InvCurr::find($this->inv_curr_id);
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
    public function updateLoc($loc)
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

    #[Renderless] 
    #[On('photo-updated')] 
    public function updatePhoto($photo)
    {
        $this->photo = $photo;
    }

    public function save()
    {
        // validate if photo url exist

        $curr       = InvCurr::find((int)$this->inv_curr_id);
        $rate       = (double)($curr ? $curr->rate : 1);
        $price      = (double)$this->price;
        $price_sec  = (double)$this->price_sec;
        $denom      = (int)$this->denom;

        if($curr && $price_sec && $rate > 0) {
            $this->price     = round(($price_sec / $rate),2);
        } else {
            $this->inv_curr_id  = '';
            $this->price        = $price;
        }

        $this->price_sec = $price_sec; 
        $this->qty_main_min   = (int)$this->qty_main_min;
        $this->qty_main_max   = (int)$this->qty_main_max;
        $this->denom = $denom > 0 ? $denom : 1;

        $props = ['name', 'desc', 'code', 'uom'];
        foreach($props as $prop) {
            $this->$prop = trim($this->$prop);
        }        
      
        $propUps = ['uom', 'code'];
        foreach ($propUps as $propUp) {
            $this->$propUp = strtoupper($this->$propUp);
        }

        $this->code = $this->code ? $this->code : null;
        $this->is_active = $this->is_active !== null ? $this->is_active : false;

        $validated = $this->validate();

        // get uom id, required
        $uom = InvUom::firstOrCreate([
            'name' => $this->uom
        ]);

        $validated['inv_curr_id'] = $this->inv_curr_id ? $this->inv_curr_id : null;
        $validated['inv_uom_id'] = $uom->id;


        if($this->inv_item->id ?? false) {
            Gate::authorize('updateOrCreate', $this->inv_item);
            $this->inv_item->update($validated);
            $msg = __('Barang diperbarui');
        } else {
            $validated['freq'] = 0;
            $validated['qty_main'] = 0;
            $validated['qty_used'] = 0;
            $validated['qty_rep'] = 0;
            $this->inv_item = new InvItem($validated);
            Gate::authorize('updateOrCreate', $this->inv_item);
            $this->inv_item->save();
            $msg = __('Barang dibuat');
        }

        $this->inv_item->updateLoc($this->loc);
        $this->inv_item->updateTags($this->tags);
        $this->inv_item->updatePhoto($this->photo);

        return redirect(route('inventory.items.show', ['id' => $this->inv_item->id]))->with('status', $msg);
    }

}
