<?php

namespace App\Livewire;

use App\Models\InvAuth;
use Livewire\Component;
use Livewire\Attributes\On;
use Livewire\Attributes\Url;
use Illuminate\Database\Eloquent\Builder;

class InvAuths extends Component
{

    #[Url]
    public $q;
    public $perPage = 10;

    #[On('updated')]
    public function render()
    {
        $q = trim($this->q);
        $auths = InvAuth::join('users', 'inv_auths.user_id', '=', 'users.id')
        ->join('inv_areas', 'inv_auths.inv_area_id', '=', 'inv_areas.id')
        ->orderBy('inv_auths.user_id', 'desc');
        
        if ($q) {
            $auths->where(function (Builder $query) use ($q) {
                $query->orWhere('users.name', 'LIKE', '%'.$q.'%')
                      ->orWhere('users.emp_id', 'LIKE', '%'.$q.'%')
                      ->orWhere('inv_areas.name','LIKE', '%'.$q.'%');
            });
        }

        $auths = $auths->paginate($this->perPage);

        return view('livewire.inv-auths', compact('auths'));
    }
}
