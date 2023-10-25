<?php

namespace App\Livewire;

use App\Models\InvItem;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Validator;

class InvItemPhoto extends Component
{
    use WithFileUploads;
    public $mode;

    public $isForm = false;

    public $id;
    public $url;
    public $photo;

    public function render()
    {
        return view('livewire.inv-item-photo');
    }

    public function updatedPhoto()
    {
        $validator = Validator::make(
            ['photo' => $this->photo ],
            ['photo' => 'nullable|mimetypes:image/jpeg,image/png,image/gif|max:1024'],
            ['mimetypes' => __('Berkas harus jpg, png, atau gif'), 'max' => __('Berkas maksimal 1 MB')]
        );

        if ($validator->fails()) {

            $errors = $validator->errors();
            $error = $errors->first('photo');
            $this->js('notyf.error("'.$error.'")'); 

        } else {

            $this->url = $this->photo ? $this->photo->temporaryUrl() : '';
            $photo = $this->photo ? $this->photo->getFilename() : '';

            if ($this->isForm) {
                $this->dispatch('photo-updated', photo: $photo);
            } else {
                $item = InvItem::find($this->id);
                if ($item) {
                    $item->updatePhoto($photo);
                    $this->js('notyf.success("'.__('Foto diperbarui').'")'); 
                }
            }

        }
    }

    public function removePhoto()
    {
        $this->photo = '';
        $this->url = '';
        $this->dispatch('photo-updated', photo: '');
    }
}
