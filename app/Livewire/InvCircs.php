<?php

namespace App\Livewire;

use App\Models\InvArea;
use App\Models\InvCirc;
use App\Models\InvCurr;
use Livewire\Component;
use Livewire\Attributes\Url;
use Illuminate\Database\Eloquent\Builder;

class InvCircs extends Component
{
    #[Url]
    public $q;
    #[Url]
    public $status = ['pending', 'approved', 'rejected'];
    #[Url]
    public $user;
    #[Url]
    public $qdirs = ['deposit', 'withdrawal', 'capture'];
    #[Url]
    public $date_start;
    #[Url]
    public $date_end;
    #[Url]
    public $area_ids = [];
    #[Url]
    public $sort = 'updated';
    public $areas;
    public $curr;
    public $perPage = 10;

    public function mount()
    {
        // update: call from pref
        $this->area_ids = ['1'];
        $this->status   = ['pending', 'approved', 'rejected'];
        $this->qdirs    = ['deposit', 'withdrawal', 'capture'];
        $this->sort     = 'updated';

        $this->areas = InvArea::all();
        $this->curr = InvCurr::find(1);
    }


    public function render()
    {
        $q = trim($this->q);
        $circs = InvCirc::join('inv_items', 'inv_circs.inv_item_id', '=', 'inv_items.id')
        ->whereIn('inv_items.inv_area_id', $this->area_ids)
        ->select('inv_circs.*', 'inv_items.name', 'inv_items.desc', 'inv_items.code');

        if ($q) {
            $circs->where(function (Builder $query) use ($q) {
                $query->orWhere('inv_items.name', 'LIKE', '%'.$q.'%')
                      ->orWhere('inv_items.desc', 'LIKE', '%'.$q.'%')
                      ->orWhere('inv_items.code', 'LIKE', '%'.$q.'%');
            });
        }

        $statusMap = [
            'pending'   => 0,
            'approved'  => 1,
            'rejected'  => 2,
        ];
        $status = [];
        foreach ($this->status as $i) {
            // Check if the status exists in the mapping
            if (array_key_exists($i, $statusMap)) {
                // Map the status to its corresponding numeric value and add to the new array
                $status[] = $statusMap[$i];
            }
        }
        if (count($status)) {
            $circs->whereIn('inv_circs.status', $status);
        } else {
            $circs->where('inv_circs.status', 9);
        }

        switch ($this->sort) {
            case 'updated':
                $circs->orderByDesc('inv_circs.updated_at');
                break;
            case 'created':
                $circs->orderByDesc('inv_circs.created_at');
                break;            
            case 'amount_low':
                $circs->orderBy('inv_circs.amount');
                break;
            case 'amount_high':
                $circs->orderByDesc('inv_circs.amount');
                break;
            case 'qty_low':
                $circs->orderBy('inv_circs.qty');
                break;
            case 'qty_high':
                $circs->orderByDesc('inv_circs.qty');
                break;        
        }

        $circs = $circs->paginate($this->perPage);

        return view('livewire.inv-circs', compact('circs'));
    }

    public function loadMore()
    {
        $this->perPage += 10;
    }
}
