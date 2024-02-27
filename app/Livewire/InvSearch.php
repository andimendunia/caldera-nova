<?php

namespace App\Livewire;

use App\Inventory;
use App\Models\Pref;
use App\Models\User;
use App\Models\InvLoc;
use App\Models\InvTag;
use League\Csv\Writer;
use App\Models\InvArea;
use App\Models\InvCurr;
use App\Models\InvItem;
use Livewire\Component;
use Illuminate\Support\Arr;
use Livewire\Attributes\Url;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;
use Illuminate\Database\Eloquent\Builder;

class InvSearch extends Component
{
    use WithPagination;

    #[Url]
    public $q = '';
    public $qwords = [];
    #[Url]
    public $status = 'active';
    #[Url]
    public $qty = 'total';
    #[Url]
    public $filter = false;
    #[Url]
    public $loc = '';
    public $qlocs = [];
    #[Url]
    public $tag = '';
    public $qtags = [];
    #[Url]
    public $without = '';
    public $areas;
    #[Url]
    public $area_ids = [];
    public $area_ids_clean = [];
    #[Url]
    public $sort = 'updated';
    #[Url]
    public $view = 'content';
    public $inv_curr;
    public $perPage = 24;

    public function mount()
    {
        $user = User::find(Auth::user()->id);
        // check for superuser
        $this->areas = $user->id === 1 ? InvArea::all() : $user->inv_areas;

        $pref = Pref::where('user_id', $user->id)->where('name', 'inv-search')->first();
        $pref = json_decode($pref->data ?? '{}', true);
        $this->q        = isset($pref['q'])         ? $pref['q']        : '';
        $this->status   = isset($pref['status'])    ? $pref['status']   : 'active';
        $this->qty      = isset($pref['qty'])       ? $pref['qty']      : 'total';
        $this->filter   = isset($pref['filter'])    ? $pref['filter']   : 'false';
        $this->loc      = isset($pref['loc'])       ? $pref['loc']      : '';
        $this->tag      = isset($pref['tag'])       ? $pref['tag']      : '';
        $this->without  = isset($pref['without'])   ? $pref['without']  : '';
        $this->area_ids = isset($pref['area_ids'])  ? $pref['area_ids'] : $this->areas->pluck('id')->toArray();
        $this->sort     = isset($pref['sort'])      ? $pref['sort']     : 'updated';
        $this->view     = isset($pref['view'])      ? $pref['view']     : 'content';

        $this->inv_curr = InvCurr::find(1);
    }

    public function render()
    {
        // cleanup areas
        $area_ids_set    = $this->area_ids;
        $area_ids_auth   = $this->areas->pluck('id')->toArray();
        
        // chosen area and authorized area
        $area_ids = array_intersect($area_ids_set, $area_ids_auth);
        $this->area_ids_clean = array_values($area_ids);

        $inv_items = Inventory::itemsBuild(
            $this->area_ids_clean,
            $this->q,
            $this->status,
            $this->filter,
            $this->loc,
            $this->tag,
            $this->without,
            $this->sort,
            $this->qty
        );

        $inv_items = $inv_items->paginate($this->perPage);

        // remember preferences
        $pref = Pref::updateOrCreate(
            ['user_id' => Auth::user()->id, 'name' => 'inv-search'],
            ['data' => json_encode([
                'q'         => $this->q,
                'status'    => $this->status,
                'qty'       => $this->qty,
                'filter'    => $this->filter,
                'loc'       => $this->loc,
                'tag'       => $this->tag,
                'without'   => $this->without,
                'area_ids'  => $this->area_ids,
                'sort'      => $this->sort,
                'view'      => $this->view,
            ])]
        );

        // update: please restrict area ids according to authorization

        return view('livewire.inv-search', compact('inv_items'));
    }

    public function resetSearch()
    {
        // reset according user access rights
        $this->area_ids = ['1'];
        $this->reset('q', 'status', 'qty', 'filter', 'loc', 'tag', 'without');
    }

    public function download()
    {
        $inv_items = Inventory::itemsBuild(
            $this->area_ids_clean,
            $this->q,
            $this->status,
            $this->filter,
            $this->loc,
            $this->tag,
            $this->without,
            $this->sort,
            $this->qty
        );

        $items = $inv_items->get();

        $curr = InvCurr::find(1)->name;
        
        // Create CSV file using league/csv
        $csv = Writer::createFromString('');
        $csv->insertOne([
            __('Area'), __('ID Caldera'),
            __('Kode'), __('Nama'), __('Deskripsi'), 
            __('Harga master'), __('Denom'), __('Harga satuan utama'), __('MU utama'), __('Harga satuan sekunder'), __('MU sekunder'),
            __('Lokasi '), __('Tag 1'), __('Tag 2'), __('Tag 3'), __('Tag 4'), __('Tag 5'),
            __('UOM'), __('Qty utama'), __('Qty bekas'), __('Qty diperbaiki'),
            __('Qty utama min'), __('Qty utama maks'), __('Aktif'), __('Dibuat pada'), __('Diperbarui pada')
        ]); // Add headers

        foreach ($items as $item) {
            $tags = $item->tags_array();
            $csv->insertOne(
                [
                    $item->inv_area->name,
                    $item->id,
                    $item->code,
                    $item->name,
                    $item->desc,
                    $item->price ?? 0,
                    $item->denom(),
                    $item->price(),
                    $curr,
                    $item->price_sec(),
                    $item->inv_curr->name ?? '',
                    $item->inv_loc->name ?? '',
                    $tags[0] ?? '',
                    $tags[1] ?? '',
                    $tags[2] ?? '',
                    $tags[3] ?? '',
                    $tags[4] ?? '',
                    $item->inv_uom->name,
                    $item->qty_main,
                    $item->qty_used,
                    $item->qty_rep,
                    $item->qty_main_min,
                    $item->qty_main_max,
                    $item->is_active ? 'Y' : 'N',
                    $item->created_at,
                    $item->updated_at
                ]
            ); // Add data rows
        }

        // Generate CSV file and return as a download
        $fileName = __('Inventaris') . '_' . date('Y-m-d_Hs') . '.csv';
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

    public function updatedLoc()
    {
        $qloc = trim($this->loc);
        $qlocs = InvLoc::whereIn('inv_locs.inv_area_id', $this->area_ids)
            ->where('name', 'LIKE', '%' . $qloc . '%')
            ->orderBy('name')
            ->take(100)
            ->get()
            ->pluck('name');
        $this->qlocs = $qlocs->toArray();
    }

    public function updatedTag()
    {
        $qtag = trim($this->tag);
        $qtags = InvTag::whereIn('inv_tags.inv_area_id', $this->area_ids)
            ->where('name', 'LIKE', '%' . $qtag . '%')
            ->orderBy('name')
            ->take(100)
            ->get()
            ->pluck('name');
        $this->qtags = $qtags->toArray();
    }

    public function updatedQ()
    {
        $keyword = trim($this->q);
        // Fetch items that contain the keyword in their name column
        if ($keyword) {
            $inv_items = InvItem::select('name', 'desc', 'code')->whereIn('inv_area_id', $this->area_ids)
                ->where(function (Builder $query) use ($keyword) {
                    $query->orWhere('name', 'LIKE', '%' . $keyword . '%')
                        ->orWhere('desc', 'LIKE', '%' . $keyword . '%')
                        ->orWhere('code', 'LIKE', '%' . $keyword . '%');
                })->limit(100)->get()->toArray();
            $inv_items = Arr::flatten($inv_items);
            $suggestions = [];

            // Extract individual words from retrieved names
            foreach ($inv_items as $name) {
                $words = explode(' ', strtolower($name));
                foreach ($words as $word) {
                    // Check if the word starts with the keyword
                    if (stripos($word, $keyword) !== false) {
                        $suggestions[] = $word;
                    }
                }
            }
            // Filter and return unique suggestions
            $suggestions = array_values(array_unique($suggestions));
            sort($suggestions);
            $this->qwords = $suggestions;
        }
    }
}
