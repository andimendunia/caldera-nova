<?php

namespace App\Livewire;

use Carbon\Carbon;
use App\Models\Pref;
use App\Models\User;
use App\Models\InvArea;
use App\Models\InvCirc;
use App\Models\InvCurr;
use Livewire\Component;
use Livewire\Attributes\On;
use Livewire\Attributes\Url;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Builder;

class InvCircs extends Component
{
    public $ids = [];
    #[Url]
    public $q = '';
    #[Url]
    public $status = ['pending', 'approved'];
    #[Url]
    public $user = '';
    #[Url]
    public $qdirs = ['deposit', 'withdrawal', 'capture'];
    #[Url]
    public $start_at = '';
    #[Url]
    public $end_at = '';
    #[Url]
    public $area_ids = [];
    #[Url]
    public $sort = 'updated';
    public $areas;
    public $inv_curr;
    public $perPage = 10;

    public function mount()
    {
        $user = User::find(Auth::user()->id);
        $this->areas = $user->id === 1 ? InvArea::all() : $user->inv_areas;
                
        $pref = Pref::where('user_id', Auth::user()->id)->where('name', 'inv-circs')->first();
        $pref = json_decode($pref->data ?? '{}', true);
        $this->q        = isset($pref['q'])         ? $pref['q']        : '';
        $this->status   = isset($pref['status'])    ? $pref['status']   : ['pending', 'approved'];
        $this->user     = isset($pref['user'])      ? $pref['user']     : '';
        $this->qdirs    = isset($pref['qdirs'])     ? $pref['qdirs']    : ['deposit', 'withdrawal', 'capture'];
        $this->start_at = isset($pref['start_at'])  ? $pref['start_at'] : Carbon::now()->startOfMonth()->format('Y-m-d');;
        $this->end_at   = isset($pref['end_at'])    ? $pref['end_at']   : Carbon::now()->endOfMonth()->format('Y-m-d');
        $this->area_ids = isset($pref['area_ids'])  ? $pref['area_ids'] : $this->areas->pluck('id')->toArray();
        $this->sort     = isset($pref['sort'])      ? $pref['sort']     : 'updated';

        $this->inv_curr = InvCurr::find(1);
    }

    #[On('updated')]
    #[On('circ-updated')]
    public function render()
    {
        $q = trim($this->q);
        // cleanup areas
        $area_ids_set       = $this->area_ids;
        $area_ids_allowed   = $this->areas->pluck('id')->toArray();
        
        $area_ids_clean = array_intersect($area_ids_set, $area_ids_allowed);
        $area_ids_clean = array_values($area_ids_clean);


        $circs = InvCirc::join('inv_items', 'inv_circs.inv_item_id', '=', 'inv_items.id')
        ->whereIn('inv_items.inv_area_id', $area_ids_clean)
        ->select('inv_circs.*', 'inv_items.name', 'inv_items.desc', 'inv_items.code');

        if ($q) {
            $circs->where(function (Builder $query) use ($q) {
                $query->orWhere('inv_items.name', 'LIKE', '%'.$q.'%')
                      ->orWhere('inv_items.desc', 'LIKE', '%'.$q.'%')
                      ->orWhere('inv_items.code', 'LIKE', '%'.$q.'%')
                      ->orWhere('inv_circs.remarks', 'LIKE', '%'.$q.'%');
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

        $user = trim($this->user);
        if($user) {
            $circs->join('users', 'inv_circs.user_id', '=', 'users.id')
            ->select('inv_circs.*', 'users.name as user_names', 'users.emp_id');
            $circs->where(function (Builder $query) use ($user) {
                $query->orWhere('users.name', 'LIKE', '%'.$user.'%')
                ->orWhere('users.emp_id', 'LIKE', '%'.$user.'%');
            });
        }

        $qdirs = $this->qdirs;
        if(count($qdirs)) {
            $circs->where(function (Builder $query) use ($qdirs) {
                $query;
                if(in_array('deposit', $qdirs)) {
                    $query->orWhere('inv_circs.qty', '>', 0);
                }
                if(in_array('withdrawal', $qdirs)) {
                    $query->orWhere('inv_circs.qty', '<', 0);
                }
                if(in_array('capture', $qdirs)) {
                    $query->orWhere('inv_circs.qty', 0);
                }
            });
        } else {
            $circs->whereNull('qty');
        }

        if($this->start_at && $this->end_at) {

            $start  = Carbon::parse($this->start_at);
            $end    = Carbon::parse($this->end_at)->addDay();

            $circs->whereBetween('inv_circs.updated_at', [$start, $end]);

        } else {
            $circs->whereNull('inv_circs.updated_at');
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
                $circs->orderByRaw('ABS(qty)');
                break;
            case 'qty_high':
                $circs->orderByRaw('ABS(qty) DESC');
                break;        
        }

        $circs = $circs->paginate($this->perPage);

        $pref = Pref::updateOrCreate(
            ['user_id' => Auth::user()->id, 'name' => 'inv-circs'],
            ['data' => json_encode([
                'q'         => $this->q,
                'status'    => $this->status,
                'user'      => $this->user,
                'qdirs'     => $this->qdirs,
                'start_at'  => $this->start_at,
                'end_at'    => $this->end_at,
                'area_ids'  => $this->area_ids,
                'sort'      => $this->sort,
            ])]
        );

        // update: please restrict area ids according to authorization

        return view('livewire.inv-circs', compact('circs'));
    }

    public function setToday()
    {
        $this->start_at = Carbon::now()->startOfDay()->format('Y-m-d');
        $this->end_at = Carbon::now()->endOfDay()->format('Y-m-d');
    }

    public function setYesterday()
    {
        $this->start_at = Carbon::yesterday()->startOfDay()->format('Y-m-d');
        $this->end_at = Carbon::yesterday()->endOfDay()->format('Y-m-d');
    }

    public function setThisMonth()
    {
        $this->start_at = Carbon::now()->startOfMonth()->format('Y-m-d');
        $this->end_at = Carbon::now()->endOfMonth()->format('Y-m-d');
    }

    public function setLastMonth()
    {
        $this->start_at = Carbon::now()->subMonthNoOverflow()->startOfMonth()->format('Y-m-d');
        $this->end_at = Carbon::now()->subMonthNoOverflow()->endOfMonth()->format('Y-m-d');
    }

    public function resetCircs()
    {
        $this->area_ids = $this->areas->pluck('id')->toArray();
        
        $this->start_at = Carbon::now()->startOfMonth()->format('Y-m-d');
        $this->end_at   = Carbon::now()->endOfMonth()->format('Y-m-d');
        $this->reset('q', 'status', 'user', 'qdirs');
    }

    public function loadMore()
    {
        $this->perPage += 10;
    }

    #[On('circ-updated')]
    public function clearIds()
    {
        $this->reset('ids');
    }
}
