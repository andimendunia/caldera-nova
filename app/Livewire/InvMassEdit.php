<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Validator;

class InvMassEdit extends Component
{
    public $step = 0;

    public $prop;
    public $ref;

    public $propName;
    public $refName;

    public function render()
    {
        return view('livewire.inv-mass-edit');
    }

    public function advance($step)
    {
        switch ($step) {
            case 0:
                $this->reset(['step', 'prop', 'ref', 'propName', 'refName']);
                break;
            case 1:
                $validated = $this->validate([ 
                    'prop' => 'required|min:1|max:6',
                    'ref' => 'required|min:1|max:2',
                ]);
                switch ($this->prop) {
                    case 1:
                        $this->propName = __('Nama dan Deskripsi');
                        break;
                    case 2:
                        $this->propName = __('Status');
                        break;
                    case 3:
                        $this->propName = __('Harga dan Mata uang');
                        break;
                    case 4:
                        $this->propName = __('Lokasi ');
                        break;
                    case 5:
                        $this->propName = __('Tag');
                        break;
                    case 6:
                        $this->propName = __('Batas qty utama');
                        break;

                }
                switch ($this->ref) {
                    case 1:
                        $this->refName = __('ID Caldera');
                        break;
                    case 2:
                        $this->refName = __('Kode item');
                        break;
                }
                $this->step = 1;
                break;
        }
    }
}
