<?php

namespace App\Livewire;

use App\Models\KpiAuth;
use Livewire\Component;
use Livewire\Attributes\On;
use Livewire\Attributes\Url;
use Illuminate\Database\Eloquent\Builder;

class KpiAuths extends Component
{

    #[Url]
    public $q;
    public $perPage = 10;

    #[On('updated')]
    public function render()
    {
        $q = trim($this->q);
        $auths = KpiAuth::join('users', 'kpi_auths.user_id', '=', 'users.id')
        ->join('kpi_areas', 'kpi_auths.kpi_area_id', '=', 'kpi_areas.id')
        ->select('kpi_auths.*', 'users.name as user_name', 'users.emp_id as user_emp_id', 'users.photo as user_photo', 'kpi_areas.name as kpi_area_name')
        
        ->orderBy('kpi_auths.user_id', 'desc');
        
        if ($q) {
            $auths->where(function (Builder $query) use ($q) {
                $query->orWhere('users.name', 'LIKE', '%'.$q.'%')
                      ->orWhere('users.emp_id', 'LIKE', '%'.$q.'%')
                      ->orWhere('kpi_areas.name','LIKE', '%'.$q.'%');
            });
        }

        $auths = $auths->paginate($this->perPage);

        return view('livewire.kpi-auths', compact('auths'));
    }
}
