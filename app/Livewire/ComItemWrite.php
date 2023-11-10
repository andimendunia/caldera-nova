<?php

namespace App\Livewire;

use App\Models\User;
use App\Models\ComItem;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Builder;

class ComItemWrite extends Component
{
    public $mod;
    public $users = [];
    public $userq;
    public $user_id;
    public $content;


    public function rules()
    {
        return [
            'user_id'   => ['required', 'integer', 'exists:App\Models\User,id'],
            'content'   => ['required', 'min:1', 'max:256'],
        ];
    }

    public function mount()
    {
        $this->user_id = Auth::user()->id;
    }

    public function render()
    {
        return view('livewire.com-item-write');
    }

    public function updatedUserq()
    {
        if($this->userq) {
            $q = $this->userq;
            $this->users = User::where(function (Builder $query) use ($q) {
                $query->orWhere('name', 'LIKE', '%'.$q.'%')
                      ->orWhere('emp_id', 'LIKE', '%'.$q.'%');
            })->where('is_active', 1)->get();
        } else {
            $this->users = [];
        }
    }

    public function save()
    {
        $this->validate();
        
        $name = class_basename($this->mod);
        if ($name == 'ComItem') {
            // child
            $parent_id = $this->mod->id;
        } else {
            // parent
            $mod_id = $this->mod->id;
            ComItem::create([
                'user_id' => $this->user_id,
                'content'   => $this->content,
                'mod'       => $name,
                'mod_id'    => $mod_id
            ]);
            $this->reset(['content']);
            $this->js('notyf.success("'.__('Komentar ditambahkan').'")'); 
            $this->dispatch('comment-added');
        }
    }
}
