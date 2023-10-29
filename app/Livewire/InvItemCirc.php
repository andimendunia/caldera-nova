<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Validation\Rule;

class InvItemCirc extends Component
{
    public $id;
    
    public $qty = '';
    public $qtype;
    public $qty_main;
    public $qty_used;
    public $qty_rep;
    public $qty_main_min;
    public $qty_main_max;
    public $curr;
    public $price;
    public $uom;
    public $remarks;

    public function rules()
    {
        return [
            'qty'       => 'required|integer|min:-99999|max:99999',
            'qtype'     => ['required_unless:qty,0', Rule::in(['main', 'used', 'rep'])],
            'remarks'   => 'required|string'
        ];
    }

    public function messages()
    {
        return [
            'qtype.required_unless' => __('Tentukan jenis qty'),
            'remarks.required' => __('Keterangan wajib diisi'),
        ];
    }


    public function mount()
    {
        $this->qtype = $this->qty_used || $this->qty_rep ? '' : 'main';
    }

    public function render()
    {
        return view('livewire.inv-item-circ');
    }

    public function submit()
    {
        $this->validate();
        dd($this);
    }
}
