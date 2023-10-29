<?php

namespace App\Livewire;

use App\Models\InvCirc;
use App\Models\InvItem;
use Livewire\Component;
use Livewire\Attributes\On;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Renderless;

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
            'qtype.required_unless' => __('Pilih jenis qty'),
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
        $this->remarks = trim($this->remarks);
        $this->validate();
        
        $inv_item = InvItem::find($this->id);
        if($inv_item) {
            // convert to number
            $qtype = ($this->qtype == 'main' ? 1 : ($this->qtype == 'used' ? 2 : ($this->qtype == 'rep' ? 3 : 0)));
            // choose qty type
            $qty_before = ($qtype == 1 ? $inv_item->qty_main : ($qtype == 2 ? $inv_item->qty_used : ($qtype == 3 ? $inv_item->qty_rep : 0)));
           
            $qty_after = $qty_before + $this->qty;

            if ($qty_after < 0) {
                $this->js('notyf.error("'.__('Qty barang negatif').'")'); 
            } else {

                InvCirc::create([
                    'qty'           => $this->qty,
                    'qtype'         => $qtype,
                    'qty_before'    => $qty_before,
                    'qty_after'     => $qty_after,
                    'amount'        => round(($inv_item->price * $this->qty), 2),
                    'user_id'       => Auth::user()->id,
                    'status'        => 0,
                    'remarks'       => $this->remarks
                ]);

                switch ($qtype) {
                    case 1:
                        $inv_item->qty_main = $qty_after;
                        $this->qty_main = $qty_after;
                        break;
                    case 2:
                        $inv_item->qty_used = $qty_after;
                        $this->qty_used = $qty_after;
                        break;
                    case 3:
                        $inv_item->qty_rep = $qty_after;
                        $this->qty_rep = $qty_after;
                        break;                  
                }

                $inv_item->is_active = true;
                $inv_item->save();
                $this->dispatch('updated');
                $this->js('notyf.success("'.__('Sirkulasi dibuat').'")'); 
                $this->qtype = $this->qty_used || $this->qty_rep ? '' : 'main';
                $this->reset(['qty', 'remarks']);
            }
        }
    }
}
