<?php

namespace App\Livewire;

use League\Csv\Reader;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Validator;

class InvMassCirc extends Component
{
    use WithFileUploads;

    public $file;
    public $is_valid = false;
    public $data = [];

    public function render()
    {
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
            $this->is_valid = false;
            $this->js('notyf.error("'.$error.'")'); 

        } else {

            $this->is_valid = true;

              // Get the path to the uploaded file
            $filePath = $this->file->getRealPath();

            // Use League\Csv\Reader to parse the CSV file
            $csv = Reader::createFromPath($filePath, 'r');
            $csv->setHeaderOffset(0); // Assume the first row contains headers

            // Define the keys you want to use
            $keys = ['code', 'name', 'desc', 'uom', 'qty', 'qtype', 'remarks']; // Add more keys as needed

            // Get the CSV data as an associative array
            $records = $csv->getRecords($keys);
            $records = iterator_to_array($records);

            foreach ($records as &$record) {
                $record['status'] = '';
            }

            $this->data = $records;

            dd($this->data);

            // You can now loop through $csvData and work with your data
            // foreach ($csvData as $record) {
            //     // $record is an associative array representing a row in the CSV
            //     dd($record);
            // }

        }
    }

    public function saveRow($rowData)
    {
        // Your logic to store the row data on the server
        // Implement your saving logic here and return success or failure
        // For example, you might save it to a database

        // Simulate a success response for demonstration
        $response = [
            'status' => 'success',
            'message'   => 'Simulasi'
        ];

        return $response;
    }

    public function reupload()
    {
        $this->reset(['file', 'is_valid']);
    }
}
