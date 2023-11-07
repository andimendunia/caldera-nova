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

    public function shuffle()
    {
        $x = rand(1, 65);

        // Format the number to ensure it's within the range of 001 to 065
        $y = sprintf('%03d', $x);
        $path = storage_path('app/public/default-avatars/zzsacdfb_' . $y . '.jpg');        
        $image = Image::make($path);
    
        // Resize the image to a maximum height of 600 pixels while maintaining aspect ratio
        $image->resize(160, 160, function ($constraint) {
            $constraint->aspectRatio();
            $constraint->upsize();
        });
        
        $image->encode('jpg', 70);

  
        // Set file name and save to disk and save filename to inv_item
        $id     = Auth::user()->id;
        $time   = Carbon::now()->format('YmdHis');
        $rand   = Str::random(5);
        $name   = $id.'_'.$time.'_'.$rand.'.jpg';

        Storage::put('//livewire-tmp/'.$name, $image);

        $this->url = 'storage/default-avatars/zzsacdfb_' . $y . '.jpg';
        $this->dispatch('photo-updated', $name);
    }
}
