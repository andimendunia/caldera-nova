<?php

namespace App\Livewire;

use App\Inventory;
use Carbon\Carbon;
use App\Models\Pref;
use App\Models\User;
use League\Csv\Writer;
use App\Models\InvArea;
use App\Models\InvCirc;
use App\Models\InvCurr;
use Livewire\Component;
use Livewire\Attributes\On;
use Livewire\Attributes\Url;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;

class InvCircs extends Component
{
    public $ids = [];
    #[Url]
    public $q = '';
    #[Url]
    public $status = ['pending', 'approved'];
    #[Url]
    public $user = '';
    #[Url]
    public $qdirs = ['deposit', 'withdrawal', 'capture'];
    #[Url]
    public $start_at = '';
    #[Url]
    public $end_at = '';
    #[Url]
    public $area_ids = [];
    public $area_ids_clean = [];
    #[Url]
    public $sort = 'updated';
    public $areas;
    public $inv_curr;
    public $perPage = 10;

    public function mount()
    {
        $user = User::find(Auth::user()->id);
        $this->areas = $user->id === 1 ? InvArea::all() : $user->inv_areas;
                
        $pref = Pref::where('user_id', Auth::user()->id)->where('name', 'inv-circs')->first();
        $pref = json_decode($pref->data ?? '{}', true);
        $this->q        = isset($pref['q'])         ? $pref['q']        : '';
        $this->status   = isset($pref['status'])    ? $pref['status']   : ['pending', 'approved'];
        $this->user     = isset($pref['user'])      ? $pref['user']     : '';
        $this->qdirs    = isset($pref['qdirs'])     ? $pref['qdirs']    : ['deposit', 'withdrawal', 'capture'];
        $this->start_at = isset($pref['start_at'])  ? $pref['start_at'] : Carbon::now()->startOfMonth()->format('Y-m-d');;
        $this->end_at   = isset($pref['end_at'])    ? $pref['end_at']   : Carbon::now()->endOfMonth()->format('Y-m-d');
        $this->area_ids = isset($pref['area_ids'])  ? $pref['area_ids'] : $this->areas->pluck('id')->toArray();
        $this->sort     = isset($pref['sort'])      ? $pref['sort']     : 'updated';

        $this->inv_curr = InvCurr::find(1);
    }

    #[On('updated')]
    #[On('circ-updated')]
    public function render()
    {
        // cleanup areas
        $area_ids_set       = $this->area_ids;
        $area_ids_allowed   = $this->areas->pluck('id')->toArray();
        
        $area_ids_clean = array_intersect($area_ids_set, $area_ids_allowed);
        $this->area_ids_clean = array_values($area_ids_clean);

        $circs = Inventory::circsBuild(
            $this->area_ids_clean, 
            $this->q, 
            $this->status, 
            $this->user, 
            $this->qdirs, 
            $this->start_at, 
            $this->end_at, 
            $this->sort
        );

        $circs = $circs->paginate($this->perPage);

        $pref = Pref::updateOrCreate(
            ['user_id' => Auth::user()->id, 'name' => 'inv-circs'],
            ['data' => json_encode([
                'q'         => $this->q,
                'status'    => $this->status,
                'user'      => $this->user,
                'qdirs'     => $this->qdirs,
                'start_at'  => $this->start_at,
                'end_at'    => $this->end_at,
                'area_ids'  => $this->area_ids,
                'sort'      => $this->sort,
            ])]
        );

        // update: please restrict area ids according to authorization

        return view('livewire.inv-circs', compact('circs'));
    }

    public function setToday()
    {
        $this->start_at = Carbon::now()->startOfDay()->format('Y-m-d');
        $this->end_at = Carbon::now()->endOfDay()->format('Y-m-d');
    }

    public function setYesterday()
    {
        $this->start_at = Carbon::yesterday()->startOfDay()->format('Y-m-d');
        $this->end_at = Carbon::yesterday()->endOfDay()->format('Y-m-d');
    }

    public function setThisMonth()
    {
        $this->start_at = Carbon::now()->startOfMonth()->format('Y-m-d');
        $this->end_at = Carbon::now()->endOfMonth()->format('Y-m-d');
    }

    public function setLastMonth()
    {
        $this->start_at = Carbon::now()->subMonthNoOverflow()->startOfMonth()->format('Y-m-d');
        $this->end_at = Carbon::now()->subMonthNoOverflow()->endOfMonth()->format('Y-m-d');
    }

    public function resetCircs()
    {
        $this->area_ids = $this->areas->pluck('id')->toArray();
        
        $this->start_at = Carbon::now()->startOfMonth()->format('Y-m-d');
        $this->end_at   = Carbon::now()->endOfMonth()->format('Y-m-d');
        $this->reset('q', 'status', 'user', 'qdirs');
    }

    public function loadMore()
    {
        $this->perPage += 10;
    }

    #[On('circ-updated')]
    public function clearIds()
    {
        $this->reset('ids');
    }

    public function print()
    {
        return redirect(route('inventory.circs.print'))->with('ids', $this->ids);
    }

    public function download()
    {
        $circs = Inventory::circsBuild(
            $this->area_ids_clean, 
            $this->q, 
            $this->status, 
            $this->user, 
            $this->qdirs, 
            $this->start_at, 
            $this->end_at, 
            $this->sort
        );

        $circs = $circs->get();

        $curr = InvCurr::find(1)->name;
        
        // Create CSV file using league/csv
        $csv = Writer::createFromString('');
        $csv->insertOne([
            __('Area'),
            __('Status'), __('Diperbarui'), __('Qty'), 
            __('Jenis qty'), __('Qty sebelum'), __('Qty sesudah'),
            __('Jumlah'), __('Mata uang'), 
            __('ID Caldera'), __('Kode'), __('Nama'), __('Desc'),
            __('Pengguna') . 'ID', __('Pengguna') . __('Nama'), __('Keterangan'),
            __('Pendelegasi') . 'ID', __('Pendelegasi') . __('Nama'), __('Pengevaluasi') . 'ID', __('Pengevaluasi') . __('Nama')]); // Add headers

        foreach ($circs as $circ) {
            $csv->insertOne(
                [
                    $circ->inv_item->inv_area->name,
                    $circ->getStatus(),
                    $circ->updated_at,
                    $circ->qty,
                    $circ->getQtype(),
                    $circ->qty_before,
                    $circ->qty_after,
                    $circ->amount,
                    $curr,
                    $circ->inv_item->id,
                    $circ->inv_item->code,
                    $circ->inv_item->name,
                    $circ->inv_item->desc,
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
        $fileName = __('Sirkulasi') . '_' . date('Y-m-d_Hs') . '.csv';
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
