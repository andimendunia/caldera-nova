<?php

namespace App\Livewire;

use App\Models\User;
use App\Models\InvCirc;
use App\Models\InvCurr;
use App\Models\InvItem;
use Livewire\Component;
use Livewire\Attributes\On;
use Livewire\Attributes\Renderless;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class InvItemCirc extends Component
{
    public $inv_item_id;
    public $inv_area_id;
    public $invItemEval = false;

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
    public $can_create = false;

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

        $this->curr     = InvCurr::find(1)->name;
        $this->uom      = $item->inv_uom->name;
        $this->qtype    = $this->qty_used || $this->qty_rep ? '' : 1;

        $user = User::find(Auth::user()->id);
        $this->can_create = in_array($this->inv_area_id, $user->invAreaIdsCircCreate());
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

        $circ = new InvCirc();
        $circ->inv_item_id  = $this->inv_item_id;
        $circ->qty          = $this->qty;
        $circ->qtype        = $this->qtype;
        $circ->amount       = round(($this->price * $this->qty), 2);
        $circ->user_id      = Auth::user()->id;
        $circ->remarks      = $this->remarks;
        $circ->qty_before   = 0;
        $circ->qty_after    = 0;
        $circ->status       = 0;

        Gate::authorize('create', $circ);

        if($this->userq && Gate::allows('eval', $circ)) {
            $user = User::where('emp_id', $this->userq)->first();
            $circ->user_id      = $user ? $user->id : $circ->user_id;
            $circ->assigner_id  = $circ->user_id == Auth::user()->id ? null : Auth::user()->id;
        }

        if ($this->is_immediate && Gate::allows('eval', $circ)) {
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
                $this->dispatch('circ-updated', ['qtype' => $approve['qtype'], 'qty_after' => $approve['qty_after']]);
                $this->js('notyf.success("'.__('Sirkulasi dibuat dan disetujui').'")'); 
            } else {
                $this->js('notyf.error("'.$approve['message'].'")'); 
            }

        } else {
            // approve 0 qty or pending approval
            if($this->qty === 0) {
                $circ->approve();
            }
                $this->dispatch('circ-added');
                $this->js('notyf.success("'.__('Sirkulasi dibuat').'")'); 
        }

        $circ->save();

        $this->qtype = $this->qty_used || $this->qty_rep ? '' : 'main';
        $this->reset(['qty', 'remarks', 'userq']);
    }

    #[On('circ-updated')]
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
        $this->qtype = $this->qty_used || $this->qty_rep ? '' : 'main';
        $this->reset(['qty', 'remarks', 'userq']);
    }
    
    #[Renderless]
    public function updatedUserq()
    {
        $this->dispatch('userq-updated', $this->userq);
    }
}
