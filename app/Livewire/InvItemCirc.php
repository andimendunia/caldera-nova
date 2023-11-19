<?php

namespace App\Livewire;

use App\Models\User;
use App\Models\InvCirc;
use App\Models\InvItem;
use Livewire\Component;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;

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

    public $userq;
    public $is_immediate = false;

    public function rules()
    {
        return [
            'qty'       => 'required|integer|min:-99999|max:99999',
            'qtype'     => 'required_unless:qty,0|min:1|max:3',
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
        $this->qtype = $this->qty_used || $this->qty_rep ? '' : 1;
    }

    public function render()
    {
        return view('livewire.inv-item-circ');
    }

    public function submit()
    {
        $this->remarks = trim($this->remarks);
        $this->validate();
        
        $item = InvItem::find($this->id);

        if($item) {

            $user = '';
            if ($this->userq) {
                $q = trim($this->userq);
                $user = User::where('emp_id', $q)->first();
                if($user->id == Auth::user()->id) {
                    $user = '';
                }
            }

            $circ = new InvCirc();
            $circ->inv_item_id  = $item->id;
            $circ->qty          = $this->qty;
            $circ->qtype        = $this->qtype;
            $circ->amount       = round(($item->price * $this->qty), 2);
            $circ->user_id      = $user ? $user->id : Auth::user()->id;
            $circ->assigner_id  = $user ? Auth::user()->id : null;
            $circ->remarks      = $this->remarks;
            $circ->qty_before   = 0;
            $circ->qty_after    = 0;
            $circ->status       = 0;

            if ($this->is_immediate || $this->qty === 0) {
                // immediate approval
                $approve = $circ->approve();
                if ($approve['success']) {
                    switch ($approve['qtype']) {
                        case 1:
                            $this->qty_main = $approve['qty_after'];
                            break;
                        case 2:
                            $this->qty_used = $approve['qty_after'];
                            break;
                        case 3:
                            $this->qty_rep = $approve['qty_after'];
                            break;
                    }
                    $this->js('notyf.success("'.__('Sirkulasi dibuat dan disetujui langsung').'")'); 
                } else {
                    $this->js('notyf.error("'.$approve['message'].'")'); 
                }

            } else {
                // pending approval
                 $this->js('notyf.success("'.__('Sirkulasi dibuat').'")'); 
            }
            $circ->save();


            $this->dispatch('updated');
            $this->qtype = $this->qty_used || $this->qty_rep ? '' : 'main';
            $this->reset(['qty', 'remarks', 'userq']);
        } else {
            $this->js('notyf.error("InvItem model not found")'); 
        }
    }

    public function updatedUserq()
    {
        $this->dispatch('userq-updated', $this->userq);
    }
}
