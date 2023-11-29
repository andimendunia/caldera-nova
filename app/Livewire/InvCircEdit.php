<?php

namespace App\Livewire;

use App\Models\User;
use App\Models\InvCirc;
use App\Models\InvCurr;
use App\Models\InvItem;
use Livewire\Component;
use Livewire\Attributes\On;
use Illuminate\Validation\Rule;
use Livewire\Attributes\Renderless;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

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
            'qtype'     => 'required_unless:qty,0|integer|min:1|max:3',
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

    #[On('circ-updated.{circ.id}')]
    public function render()
    {
        return view('livewire.inv-circ-edit');
    }

    public function update()
    {
        // update: test this code
        Gate::authorize('update', $this->circ);
        $this->remarks = trim($this->remarks);
        $this->userq = Gate::allows('eval', $this->circ) ? trim ($this->userq) : '';
        $this->validate();

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

        $this->circ->save();
        $this->js('window.dispatchEvent(escKey)'); 
        $this->dispatch('circ-updated.' . $this->circ->id);
        $this->dispatch('circ-updated'); 
        
        $this->js('notyf.success("' . __('Sirkulasi diperbarui') . '")'); 
    }

    public function eval($type)
    {
        Gate::authorize('eval', $this->circ);
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
                if ($approve['status'] === 'success') {
                    $this->circ->save();
                    $this->js('window.dispatchEvent(escKey)'); 
                    $this->dispatch('circ-item-updated', ['qtype' => $approve['qtype'], 'qty_after' => $approve['qty_after']]);
                    $this->dispatch('circ-updated.' . $this->circ->id);
                    $this->dispatch('circ-updated');
                }
                $this->js('notyf.'.$approve['status'].'("'.$approve['message'].'")'); 
                break;
            case 'reject':
                $reject = $this->circ->reject();
                if ($reject['status'] === 'success') {
                    $this->circ->save();
                    $this->js('window.dispatchEvent(escKey)'); 
                    $this->dispatch('circ-updated.' . $this->circ->id);
                    $this->dispatch('circ-updated');                    
                } 
                $this->js('notyf.'.$reject['status'].'("'.$reject['message'].'")'); 
                break;            
        }

    }
}
