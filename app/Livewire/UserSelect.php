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

    #[On('user-updated')] 
    public function search($user)
    {
        if($user) {
            $this->users = User::where(function (Builder $query) use ($user) {
                $query->orWhere('name', 'LIKE', '%'.$user.'%')
                      ->orWhere('emp_id', 'LIKE', '%'.$user.'%');
            })->where('is_active', 1)->get();
        } else {
            $this->users = [];
        }

    }

    public function select($emp_id)
    {
        $this->dispatch('user-selected', $emp_id);
    }

}
