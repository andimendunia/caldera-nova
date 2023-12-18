<?php

namespace App\Livewire;

use League\Csv\Reader;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class InvMassEdit extends Component
{
    use WithFileUploads;
    
    public $step = 0;

    public $prop;
    public $ref;

    public $propCode;
    public $propName;
    public $refCode;
    public $refName;

    public $file;

    public function render()
    {
        return view('livewire.inv-mass-edit');
    }

    public function advance($step)
    {
        switch ($step) {
            case 0:
                $this->reset(['step']);
                break;
            case 1:
                $validated = $this->validate([ 
                    'prop' => 'required|min:1|max:6',
                    'ref' => 'required|min:1|max:2',
                ]);
                switch ($this->prop) {
                    case 1:
                        $this->propName = __('Nama dan Deskripsi');
                        $this->propCode = 'name_desc';
                        break;
                    case 2:
                        $this->propName = __('Status');
                        $this->propCode = 'status';
                        break;
                    case 3:
                        $this->propName = __('Harga dan Mata uang');
                        $this->propCode = 'price_currency';
                        break;
                    case 4:
                        $this->propName = __('Lokasi ');
                        $this->propCode = 'location';
                        break;
                    case 5:
                        $this->propName = __('Tag');
                        $this->propCode = 'tag';
                        break;
                    case 6:
                        $this->propName = __('Batas qty utama');
                        $this->propCode = 'main_qty_limit';
                        break;

                }
                switch ($this->ref) {
                    case 1:
                        $this->refName = __('ID Caldera');
                        $this->refCode = 'cal_id';
                        break;
                    case 2:
                        $this->refName = __('Kode item');
                        $this->refCode = 'item_code';
                        break;
                }
                $this->step = 1;
                break;
        }
    }

    public function download()
    {
        $this->js('notyf.success("'. __('Pengunduhan dimulai...').'")'); 
        return Storage::download('/public/mass_edit_' . $this->refCode . '_' . $this->propCode .  '.csv');
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
            // $this->isValid = false;
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
    
                // $this->circs = $circs;
                // $this->isValid = true;

            }

        }
    }
    
}
