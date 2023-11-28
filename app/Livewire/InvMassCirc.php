<?php

namespace App\Livewire;

use App\Models\User;
use League\Csv\Reader;
use App\Models\InvArea;
use Livewire\Component;
use Livewire\Attributes\Url;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class InvMassCirc extends Component
{
    use WithFileUploads;

    public $file;
    public $isValid     = false;
    public $circs        = [];

    #[Url] 
    public $area_id = '';
    public $areas;

    public function render()
    {
        $user = User::find(Auth::user()->id);
        $this->areas = InvArea::whereIn('id', $user->invAreaIdsItemCreate())->get();
        return view('livewire.inv-mass-circ');
    }

    public function updatedFile()
    {
        
        $validator = Validator::make(
            ['file' => $this->file ],
            ['file' => 'required|mimetypes:text/csv|max:1024'],
            ['mimetypes' => __('Berkas harus berupa CSV'), 'max' => __('Berkas maksimal 1 MB')]
        );

        if ($validator->fails()) {

            $errors = $validator->errors();
            $error = $errors->first('file');
            $this->isValid = false;
            $this->js('notyf.error("'.$error.'")'); 

        } else {
              // Get the path to the uploaded file
            $filePath = $this->file->getRealPath();

            // Use League\Csv\Reader to parse the CSV file
            $csv = Reader::createFromPath($filePath, 'r');
            $csv->setHeaderOffset(0); // Assume the first row contains headers

            // Define the keys you want to use
            $keys = ['code', 'name', 'desc', 'uom', 'qty', 'qtype', 'remarks']; // Add more keys as needed

            // Get the CSV data as an associative array
            $circs = $csv->getrecords($keys);
            $rowCount = iterator_count($circs);

            if($rowCount > 100) {

                $this->js('notyf.error("'. __('Data memiliki 100 baris lebih').'")'); 

            } else {

                $circs = iterator_to_array($circs, false);

                foreach ($circs as &$circ) {
                    $circ['status'] = '';
                }
    
                $this->circs = $circs;
                $this->isValid = true;

            }

        }
    }

    public function reupload()
    {
        $this->reset(['file', 'isValid']);
    }

    public function download()
    {
        $this->js('notyf.success("'. __('Pengunduhan dimulai...').'")'); 
        return Storage::download('/public/mass-circ.csv');
    }
}
