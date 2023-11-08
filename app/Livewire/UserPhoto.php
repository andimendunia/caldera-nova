<?php

namespace App\Livewire;

use Carbon\Carbon;
use Livewire\Component;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class UserPhoto extends Component
{
    use WithFileUploads;
    public $mode;

    public $id;
    public $url;
    public $temp;

    public function render()
    {
        return view('livewire.user-photo');
    }

    public function updatedTemp()
    {
        $validator = Validator::make(
            ['temp' => $this->temp ],
            ['temp' => 'nullable|mimetypes:image/jpeg,image/png,image/gif|max:1024'],
            ['mimetypes' => __('Berkas harus jpg, png, atau gif'), 'max' => __('Berkas maksimal 1 MB')]
        );

        if ($validator->fails()) {

            $errors = $validator->errors();
            $error = $errors->first('temp');
            $this->js('notyf.error("'.$error.'")'); 

        } else {

            $this->url = $this->temp ? $this->temp->temporaryUrl() : '';
            $temp = $this->temp ? $this->temp->getFilename() : '';
            $this->dispatch('photo-updated', $temp);
        }

    }

    public function removeTemp()
    {
        $this->dispatch('photo-updated', '');
        $this->temp = '';
        $this->url = '';
    }
}
