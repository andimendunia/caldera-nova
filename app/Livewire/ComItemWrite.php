<?php

namespace App\Livewire;

use App\Models\User;
use App\Models\ComItem;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Builder;
use Livewire\WithFileUploads;

class ComItemWrite extends Component
{
    use WithFileUploads;

    public $mod;
    public $parent_id;
    public $users = [];
    public $userq;
    public $user_id;
    public $content;
    public $files = [];
    
    public function rules()
    {
        return [
            'user_id'   => ['required', 'integer', 'exists:App\Models\User,id'],
            'content'   => ['required_without:files', 'max:999'],
            'files.*'   => ['max:51200'],
        ];
    }

    public function messages()
    {
        return [
            'content.required_without' => __('Isi komentar atau unggah lampiran')
        ];
    }

    public function placeholder()
    {
        return view('livewire.modal-placeholder');
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
        // dd($this);
        
        $name = class_basename($this->mod);
        $com_item = ComItem::create([
            'user_id' => $this->user_id,
            'content'   => $this->content,
            'mod'       => $name,
            'mod_id'    => $this->mod->id,
        ]);

        if ($this->parent_id) {
            $com_item->update([
                'parent_id' => $this->parent_id,
            ]);
        }

        // handle files here
        foreach($this->files as $file) {
            $com_item->saveFile($file);
        }

        $this->reset(['content', 'files']);
        $this->js('notyf.success("'.__('Komentar ditambahkan').'")'); 
        $this->dispatch('comment-added');
    }

    public function resetFiles()
    {
        $this->reset(['files']);
    }

    public function updatedFiles()
    {
        // dd($this->files);
    }
}
