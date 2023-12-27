<?php

namespace App\Livewire;

use Carbon\Carbon;
use League\Csv\Writer;
use App\Models\InvCirc;
use App\Models\InvCurr;
use Livewire\Component;
use Illuminate\Support\Facades\Response;

class InvItemCircsDownload extends Component
{
    public $id;
    public $start_date;
    public $end_date;

    public function placeholder()
    {
        return view('livewire.modal-placeholder');
    }

    public function mount()
    {
        $this->start_date = Carbon::now()->subMonth()->startOfMonth()->format('Y-m-d');
        $this->end_date = Carbon::now()->format('Y-m-d');
        
    }
    
    public function render()
    {
        return view('livewire.inv-item-circs-download');
    }

    public function download()
    {
        $start  = Carbon::parse($this->start_date);
        $end    = Carbon::parse($this->end_date)->addDay();
        
        // Retrieve data from the 'inv_circs' table
        $circs = InvCirc::where('inv_item_id', $this->id)
        ->orderByDesc('inv_circs.updated_at')
        ->whereBetween('inv_circs.updated_at', [$start, $end])
        ->limit(1000)
        ->get();
        $curr = InvCurr::find(1)->name;

        // Create CSV file using league/csv
        $csv = Writer::createFromString('');
        $csv->insertOne([
            __('Status'), __('Diperbarui'), __('Qty'), 
            __('Jenis qty'), __('Qty sebelum'), __('Qty sesudah'),
            __('Jumlah'), __('Mata uang'), __('Pengguna') . 'ID', __('Pengguna') . __('Nama'), __('Keterangan'),
            __('Pendelegasi') . 'ID', __('Pendelegasi') . __('Nama'), __('Pengevaluasi') . 'ID', __('Pengevaluasi') . __('Nama')]); // Add headers

        foreach ($circs as $circ) {
            $csv->insertOne(
                [
                    $circ->getStatus(),
                    $circ->updated_at,
                    $circ->qty,
                    $circ->getQtype(),
                    $circ->qty_before,
                    $circ->qty_after,
                    $circ->amount,
                    $curr,
                    $circ->user->emp_id,
                    $circ->user->name,
                    $circ->remarks,
                    $circ->assigner->emp_id ?? '',
                    $circ->assigner->name ?? '',
                    $circ->evaluator->emp_id ?? '',
                    $circ->evaluator->name ?? '',
                ]
            ); // Add data rows
        }

        // Generate CSV file and return as a download
        $fileName = $circ->inv_item_id . '_' . $circ->inv_item->name . '_' . date('Y-m-d_Hs') . '.csv';
        $this->js('window.dispatchEvent(escKey)'); 
        $this->js('notyf.success("'.__('Pengunduhan dimulai...').'")'); 

        return Response::stream(
            function () use ($csv) {
                echo $csv->toString();
            },
            200,
            [
                'Content-Type' => 'text/csv',
                'Content-Disposition' => 'attachment; filename="' . $fileName . '"',
            ]
        );
    }

    
}
