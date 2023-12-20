<?php

namespace App\Livewire;

use App\Models\User;
use League\Csv\Reader;
use App\Models\InvArea;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Auth;
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
    public $a;
    public $b;

    public $file;
    public $rows = [];

    public $area_id = '';
    public $areas;

    public function render()
    {
        $user = User::find(Auth::user()->id);
        $this->areas = InvArea::whereIn('id', $user->invAreaIdsItemCreate())->get();
        return view('livewire.inv-mass-edit');
    }

    public function advance($step)
    {
        switch ($step) {
            case 0:
                $this->reset(['step']);
                break;
            case 1:
                $this->validate([ 
                    'prop' => 'required|min:1|max:6',
                    'ref' => 'required|min:1|max:2',
                ]);
                switch ($this->prop) {
                    case 1:
                        $this->propName = __('Nama dan Deskripsi');
                        $this->propCode = 'name_desc';
                        $this->a = __('Nama');
                        $this->b = __('Deskripsi');
                        break;
                    case 2:
                        $this->propName = __('Status');
                        $this->propCode = 'status';
                        $this->a = __('Status');
                        $this->b = '';
                        break;
                    case 3:
                        $this->propName = __('Harga dan Mata uang');
                        $this->propCode = 'price_currency';
                        $this->a = __('Nama');
                        $this->b = __('Mata uang');
                        break;
                    case 4:
                        $this->propName = __('Lokasi ');
                        $this->propCode = 'location';
                        $this->a = __('Lokasi');
                        $this->b = '';
                        break;
                    case 5:
                        $this->propName = __('Tag');
                        $this->propCode = 'tag';
                        $this->a = __('Tag');
                        $this->b = '';
                        break;
                    case 6:
                        $this->propName = __('Batas qty utama');
                        $this->propCode = 'main_qty_limit';
                        $this->a = __('Qty min');
                        $this->b = __('Qty maks');
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
            $rows = $csv->getrecords($keys);
            $rowCount = iterator_count($rows);

            if($rowCount > 100) {

                $this->js('notyf.error("'. __('Data memiliki 100 baris lebih').'")'); 

            } else {

                $rows = iterator_to_array($rows, false);

                foreach ($rows as &$row) {
                    $row['status'] = '';
                }

                $this->step = 2;
    
                $this->rows = $rows;
                // $this->isValid = true;

            }

        }
    }
    
}
