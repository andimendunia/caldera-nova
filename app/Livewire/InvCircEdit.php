<?php

namespace App\Livewire;

use App\Models\User;
use App\Models\InvCirc;
use App\Models\InvCurr;
use App\Models\InvItem;
use Livewire\Component;
use Livewire\Attributes\On;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Renderless;

class InvCircEdit extends Component
{
    public InvItem $inv_item;
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

    public $uom;
    public $price;
    public $curr;

    public $userq;

    public function rules()
    {
        return [
            'qty'       => 'required|integer|min:-99999|max:99999',
            'qtype'     => 'required_unless:qty,0|min:1|max:3',
            'remarks'   => 'required|string'
        ];
    }

    public function mount(InvCirc $circ)
    {
        $this->fill($circ->only('inv_item_id', 'qty', 'qtype', 'qty_before', 'qty_after', 'amount', 'user_id', 'assigner_id', 'evaluator_id', 'status', 'remarks', 'comment'));
        
        $this->inv_item = InvItem::find($this->inv_item_id);
        $this->uom      = $this->inv_item->inv_uom->name;
        $this->price    = $this->inv_item->price;

        $this->userq    = $this->circ->user->emp_id;
        $this->curr     = InvCurr::find(1)->name;
    }

    #[Renderless]
    public function updatedUserq()
    {
        $this->dispatch('userq-updated', $this->userq);
    }
    
    public function placeholder()
    {
        return view('livewire.modal-placeholder');
    }

    #[On('circ-approved.{circ.id}')]
    public function render()
    {
        return view('livewire.inv-circ-edit');
    }

    public function eval($type)
    {
        $this->remarks = trim($this->remarks);
        $this->userq = trim($this->userq);
        $this->validate();

        // delegate to...
        if ($this->userq) {
            $user = User::where('emp_id', $this->userq)->first();
            $userId = $user ? $user->id : $this->circ->user_id;
        }

        $dirty = 0;
        $dirty = $this->circ->qty != $this->qty ? ++$dirty : $dirty;
        $dirty = $this->circ->qtype != $this->qtype ? ++$dirty : $dirty;
        $dirty = $this->circ->remarks != $this->remarks ? ++$dirty : $dirty;
        $dirty = $this->circ->user_id != $userId ? ++$dirty : $dirty;

        $assignerId = $dirty > 0 ? Auth::user()->id : $this->circ->assigner_id;
        $assignerId = $assignerId == $userId ? null : $assignerId;

        $this->circ->qty        = $this->qty;
        $this->circ->qtype      = $this->qtype;
        $this->circ->remarks    = $this->remarks;
        $this->circ->user_id    = $userId;
        $this->circ->assigner_id = $assignerId;

        switch ($type) {
            case 'approve':
                $approve = $this->circ->approve();
                if ($approve['success']) {
                    $this->circ->save();
                    $this->js('window.dispatchEvent(escKey)'); 
                    $this->js('notyf.success("'.$approve['message'].'")'); 
                    $this->dispatch('circ-approved', ['qtype' => $approve['qtype'], 'qty_after' => $approve['qty_after']]);
                    $this->dispatch('circ-approved.' . $this->circ->id);
                } else {
                    $this->js('notyf.error("'.$approve['message'].'")'); 
                }
                break;
            case 'reject':
                dd('WHYY you reject meeee.....');
                break;            
        }

    }
}
