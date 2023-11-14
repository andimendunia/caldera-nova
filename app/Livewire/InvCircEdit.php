<?php

namespace App\Livewire;

use App\Models\User;
use App\Models\InvCirc;
use App\Models\InvCurr;
use App\Models\InvItem;
use Livewire\Component;

class InvCircEdit extends Component
{
    public InvCirc $circ;

    public $inv_item_id;
    public $qty;
    public $qtype;
    public $qty_before;
    public $qty_after;
    public $amount;
    public $user_id;
    public $assigner_id;
    public $evaluator_id;
    public $status;
    public $remarks;
    public $comment;

    public $dir;
    public $uom;
    public $price;
    public $curr;

    public function mount(InvCirc $circ)
    {
        $this->fill($circ->only('inv_item_id', 'qty', 'qtype', 'qty_before', 'qty_after', 'amount', 'user_id', 'assigner_id', 'evaluator_id', 'status', 'remarks', 'comment'));

        $this->dir = ($this->qty < 0) ? __('Ambil') : (($this->qty > 0) ? __('Tambah') : __('Catat'));
        $this->uom = $this->circ->inv_item->inv_uom->name;
        $this->price = $this->circ->inv_item->price;
        $this->curr = InvCurr::find(1)->name;

    }

    
    public function placeholder()
    {
        return view('livewire.modal-placeholder');
    }

    public function render()
    {
        return view('livewire.inv-circ-edit');
    }
}
