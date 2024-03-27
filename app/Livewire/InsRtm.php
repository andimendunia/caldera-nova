<?php

namespace App\Livewire;

use Carbon\Carbon;
use League\Csv\Writer;
use Livewire\Component;
use App\Models\InsRtmMetric;
use Livewire\Attributes\Url;
use Illuminate\Support\Facades\Response;

class InsRtm extends Component
{
    #[Url]
    public $view = 'line-all';

    #[Url]
    public $start_at;

    #[Url]
    public $end_at;

    #[Url]
    public $fline;

    #[Url]
    public $sline;
    public $olines = [];

    public $lineViews   = ['line-single'];
    public $dateViews   = ['raw', 'line-single'];
    public $rangeViews  = ['raw'];
    public $filterViews = ['raw', 'line-all'];
    
    public $dataIntegrity = 0;
    public $dataAccuracy = 0;
    public $dayCount = 0;

    public $is_line;
    public $is_date;
    public $is_range;
    public $is_filter;

    public function mount()
    {
        $this->setToday();
        $this->olines = InsRtmMetric::select('line')
        ->distinct()
        ->orderBy('line')
        ->get()
        ->pluck('line')
        ->toArray();
    }

    public function render()
    {
        $this->is_date      = in_array($this->view, $this->dateViews);
        $this->is_range     = in_array($this->view, $this->rangeViews);
        $this->is_line      = in_array($this->view, $this->lineViews);
        $this->is_filter    = in_array($this->view, $this->filterViews);

        return view('livewire.ins-rtm', ['start_at' => $this->start_at, 'end_at' => $this->end_at, 'fline' => $this->fline ]);
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

    public function resetFilter()
    {
        $this->reset('fline');
    }

    public function download()
    {
        if ($this->view == 'raw')
        {
            $start  = Carbon::parse($this->start_at);
            $end    = Carbon::parse($this->end_at)->addDay();
    
            $metrics = InsRtmMetric::whereBetween('dt_client', [$start, $end])->orderBy('dt_client', 'DESC');
    
            $items = $metrics->get();
            
            // Create CSV file using league/csv
            $csv = Writer::createFromString('');
            $csv->insertOne([
                __('Waktu alat'), __('Line'), __('Tebal kiri'), __('Tebal kanan'),
            ]); // Add headers

            foreach ($items as $item) {
                $csv->insertOne(
                    [
                        $item->dt_client,
                        $item->line,
                        $item->thick_act_left,
                        $item->thick_act_right,
                    ]
                ); // Add data rows
            }
    
            // Generate CSV file and return as a download
            $fileName = __('Wawasan_RTM') . '_' . date('Y-m-d_Hs') . '.csv';
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
}
