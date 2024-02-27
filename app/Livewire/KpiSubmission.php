<?php

namespace App\Livewire;

use App\Models\Pref;
use App\Models\KpiArea;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class KpiSubmission extends Component
{
    public $areas;
    public $area_id;

    public $filter = '';

    public function mount()
    {
        $this->areas = KpiArea::all();
    }

    public function render()
    {
        // remember preferences
        $pref = Pref::updateOrCreate(
            ['user_id' => Auth::user()->id, 'name' => 'kpi-submission'],
            [
                'data' => json_encode([
                    'filter' => $this->filter,
                ]),
            ],
        );
        
        return view('livewire.kpi-submission');
    }
}
