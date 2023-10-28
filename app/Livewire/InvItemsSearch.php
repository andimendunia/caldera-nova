<?php

namespace App\Livewire;

use App\Models\InvLoc;
use App\Models\InvTag;
use App\Models\InvArea;
use App\Models\InvCurr;
use App\Models\InvItem;
use Livewire\Component;
use Livewire\Attributes\Url;
use Livewire\WithPagination;
use Illuminate\Database\Eloquent\Builder;

class InvItemsSearch extends Component
{
    use WithPagination;

    #[Url]
    public $q = '';
    public $qwords;

    #[Url]
    public $status = 'active';
    #[Url]
    public $qty = 'total';
    #[Url]
    public $filter = false;

    #[Url]
    public $loc = '';
    public $qlocs = [];
    #[Url]
    public $tag = '';
    public $qtags = [];

    #[Url]
    public $without = '';

    public $areas;
    #[Url]
    public $area_ids = [];

    #[Url]
    public $sort = 'updated';
    #[Url]
    public $view = 'content';

    public $inv_curr;
    public $perPage = 24;

    public function mount()
    {
        // update: call from pref
        $this->area_ids = ['1'];
        $this->sort = 'updated';
        $this->view = 'content';
        $this->status = 'active';
        $this->qty = 'total';
        $this->filter = false;
        $this->inv_curr = InvCurr::find(1);

        $this->areas = InvArea::all();
    }

    public function render()
    {
        $q = trim($this->q);
        $inv_items = InvItem::whereIn('inv_items.inv_area_id', $this->area_ids)
        ->where(function (Builder $query) use ($q) {
            $query->orWhere('inv_items.name', 'LIKE', '%'.$q.'%')
                  ->orWhere('inv_items.desc', 'LIKE', '%'.$q.'%')
                  ->orWhere('inv_items.code', 'LIKE', '%'.$q.'%');
        });
        switch ($this->status) {
            case 'inactive':
                $inv_items->where('inv_items.is_active', false);
                break;
            case 'both':
                //
                break;
            default:
                $inv_items->where('inv_items.is_active', true);
                break;
        }
        if($this->filter) {
            if($this->loc) {
                $loc = trim($this->loc);
                $inv_items->join('inv_locs', 'inv_items.inv_loc_id', '=', 'inv_locs.id')
                ->where('inv_locs.name', 'like', '%'.$loc.'%');
            }
            if($this->tag) {
                $tag = trim($this->tag);
                $inv_items->join('inv_item_tags', 'inv_items.id', '=', 'inv_item_tags.inv_item_id')
                ->join('inv_tags', 'inv_item_tags.inv_tag_id', '=', 'inv_tags.id')
                ->where('inv_tags.name', 'like', '%'.$tag.'%');
            }
            switch ($this->without) {
                case 'loc':
                    $inv_items->whereNull('inv_items.inv_loc_id');
                    break;
                case 'tags':
                    $inv_items->whereNotIn('id', function ($query) {
                        $query->select('inv_item_id')->from('inv_item_tags');
                    });
                    break;
                case 'photo':
                    $inv_items->whereNull('inv_items.photo');
                    break;
                case 'code':
                    $inv_items->whereNull('inv_items.code');
                    break;
                case 'qty_main_min':
                    $inv_items->where('inv_items.qty_main_min', 0);
                    break;
                case 'qty_main_max':
                    $inv_items->where('inv_items.qty_main_max', 0);
                    break;
                
            }            
        }
        
        switch ($this->sort) {
            case 'updated':
                $inv_items->orderBy('inv_items.updated_at');
                break;
            case 'created':
                $inv_items->orderBy('inv_items.created_at');
                break;            
            case 'price_low':
                $inv_items->orderBy('inv_items.price');
                break;
            case 'price_high':
                $inv_items->orderByDesc('inv_items.price');
                break;
            case 'qty_low':
                switch ($this->qty) {
                    case 'total':
                        $inv_items->selectRaw('*, (inv_items.qty_main + inv_items.qty_used + inv_items.qty_rep) as qty_total')
                        ->orderBy('qty_total');
                        break;
                    case 'main':
                        $inv_items->orderBy('inv_items.qty_main');
                        break;
                    case 'used':
                        $inv_items->orderBy('inv_items.qty_used');
                        break;
                    case 'rep':
                        $inv_items->orderBy('inv_items.qty_rep');
                        break;
                }
                break;
            case 'qty_high':
                switch ($this->qty) {
                    case 'total':
                        $inv_items->selectRaw('*, (inv_items.qty_main + inv_items.qty_used + inv_items.qty_rep) as qty_total')
                        ->orderByDesc('qty_total');
                        break;
                    case 'main':
                        $inv_items->orderByDesc('inv_items.qty_main');
                        break;
                    case 'used':
                        $inv_items->orderByDesc('inv_items.qty_used');
                        break;
                    case 'rep':
                        $inv_items->orderByDesc('inv_items.qty_rep');
                        break;
                }
                break;
                break;

            case 'alpha':
                $inv_items->orderBy('inv_items.name');
                break;
            
        }

        $inv_items = $inv_items->paginate($this->perPage);

        return view('livewire.inv-items-search', compact('inv_items'));
    }

    public function resetSearch()
    {
        // reset according user pref
        $this->area_ids = ['1'];
        $this->reset('q', 'status', 'qty', 'filter', 'loc', 'tag', 'without');
    }

    public function updatedLoc()
    {
        $qloc = trim($this->loc);
        $qlocs = InvLoc::whereIn('inv_locs.inv_area_id', $this->area_ids)
        ->where('name', 'LIKE', '%'.$qloc.'%')
        ->orderBy('name')
        ->take(100)
        ->get()
        ->pluck('name');
        $this->qlocs = $qlocs->toArray();
    }

    public function updatedTag()
    {
        $qtag = trim($this->tag);
        $qtags = InvTag::whereIn('inv_tags.inv_area_id', $this->area_ids)
        ->where('name', 'LIKE', '%'.$qtag.'%')
        ->orderBy('name')
        ->take(100)
        ->get()
        ->pluck('name');
        $this->qtags = $qtags->toArray();
    }

}
