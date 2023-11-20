<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Component;
use Livewire\Attributes\On;
use Illuminate\Database\Eloquent\Builder;

class UserSelect extends Component
{

    public $users = [];
    

    public function render()
    {
        return view('livewire.user-select');
    }

    #[On('userq-updated')] 
    public function search($userq)
    {
        if($userq) {
            $this->users = User::where(function (Builder $query) use ($userq) {
                $query->orWhere('name', 'LIKE', '%'.$userq.'%')
                      ->orWhere('emp_id', 'LIKE', '%'.$userq.'%');
            })->where('is_active', 1)->get();
        } else {
            $this->users = [];
        }

    }

}
