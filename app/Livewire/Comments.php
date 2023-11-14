<?php

namespace App\Livewire;

use App\Models\ComFile;
use App\Models\ComItem;
use Livewire\Component;
use Livewire\Attributes\On;
use Illuminate\Support\Facades\Storage;

class Comments extends Component
{
    public $mod;

    public $name;
    public $id;

    public function mount()
    {
        $this->name = class_basename($this->mod);
        $this->id = $this->mod->id;
    }
    
    
    #[On('comment-added')]
    public function render()
    {
        $comments = ComItem::orderByDesc('updated_at')->where('mod', $this->name)->where('mod_id', $this->id)->whereNull('parent_id')->get();
        $count = ComItem::orderByDesc('updated_at')->where('mod', $this->name)->where('mod_id', $this->id)->count();
        return view('livewire.comments', compact('comments', 'count'));
    }

    public function download($id)
    {
        $file = ComFile::find($id);

        if ($file && Storage::exists('/public/com-files/' . $file->name ?? '')) {
            $this->js('notyf.success("'.__('Pengunduhan dimulai...').'")'); 
            return Storage::download('/public/com-files/' . $file->name, $file->client_name);
        } else {
            $this->js('notyf.error("'.__('Berkas tidak ditemukan').'")');
        }
    }

}
