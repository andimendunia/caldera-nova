<?php

namespace App\Livewire;

use App\Models\User;
use App\Models\InvCirc;
use App\Models\InvCurr;
use App\Models\InvItem;
use Livewire\Component;
use Livewire\Attributes\On;
use Illuminate\Support\Facades\Auth;

class InvItemCirc extends Component
{
    public $inv_item_id;
    
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

    public $qty_main_after = 0;
    public $qty_used_after = 0;
    public $qty_rep_after = 0;

    public $userq;
    public $is_immediate = false;

    public function rules()
    {
        return [
            'qty'       => 'required|integer|min:-99999|max:99999',
            'qtype'     => 'required|min:1|max:3',
            'remarks'   => 'required|string'
        ];
    }

    public function messages()
    {
        return [
            'qtype.required' => __('Pilih jenis qty'),
            'remarks.required' => __('Keterangan wajib diisi'),
        ];
    }

    public function mount()
    {
        $item = InvItem::find($this->inv_item_id);
        $this->fill(
            $item->only('qty_main', 'qty_used', 'qty_rep', 'qty_main_min', 'qty_main_max', 'price')
        );

        // $this->qty_main_after = $item->qty_main;
        // $this->qty_used_after = $item->qty_used;
        // $this->qty_rep_after = $item->qty_rep;

        $this->curr     = InvCurr::find(1)->name;
        $this->uom      = $item->inv_uom->name;
        $this->qtype    = $this->qty_used || $this->qty_rep ? '' : 1;
    }

    public function render()
    {
        return view('livewire.inv-item-circ');
    }

    public function submit()
    {
        $this->remarks = trim($this->remarks);
        $this->userq = trim($this->userq);
        $this->validate();

        // delegate to...
        $userId = Auth::user()->id;
        if ($this->userq) {
            $user = User::where('emp_id', $this->userq)->first();
            $userId = $user ? $user->id : $userId;
        }

        $assignerId = $userId == Auth::user()->id ? null : Auth::user()->id;

        $circ = new InvCirc();
        $circ->inv_item_id  = $this->inv_item_id;
        $circ->qty          = $this->qty;
        $circ->qtype        = $this->qtype;
        $circ->amount       = round(($this->price * $this->qty), 2);
        $circ->user_id      = $userId;
        $circ->assigner_id  = $assignerId;
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
    }

    #[On('circ-approved')]
    public function circApproved($data)
    {
        switch ($data['qtype']) {
            case 1:
                $this->qty_main = $data['qty_after'];
                $this->qty_main_after = $data['qty_after'];
                break;
            case 2:
                $this->qty_used = $data['qty_after'];
                $this->qty_used_after = $data['qty_after'];
                break;
            case 3:
                $this->qty_rep = $data['qty_after'];
                $this->qty_rep_after = $data['qty_after'];
                break;
            
        }
    }

    public function updatedUserq()
    {
        $this->dispatch('userq-updated', $this->userq);
    }
}
