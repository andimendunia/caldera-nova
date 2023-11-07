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

    public $user;

    public $is_delegated = false;
    public $is_immediate = false;

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
        
        $item = InvItem::find($this->id);

        if($item) {

            // convert to number
            $qtype = ($this->qtype == 'main' ? 1 : ($this->qtype == 'used' ? 2 : ($this->qtype == 'rep' ? 3 : 0)));

            switch ($qtype) {
                case 1:
                    $qty_before = $item->qty_main;
                    break;
                case 2:
                    $qty_before = $item->qty_used;
                    break;
                case 3:
                    $qty_before = $item->qty_rep;
                    break;
            }  

            $user = '';
            if ($this->user) {
                $user = User::where('emp_id', $this->user)->first();
                if($user->id == Auth::user()->id) {
                    $user = '';
                }
            }

            $circ = InvCirc::create([
                'inv_item_id'   => $item->id,
                'qty'           => $this->qty,
                'qtype'         => $qtype,
                'qty_before'    => $qty_before,
                'qty_after'     => $qty_before,
                'amount'        => round(($item->price * $this->qty), 2),
                'user_id'       => $user ? $user->id : Auth::user()->id,
                'assigner_id'   => $user ? Auth::user()->id : null,
                'status'        => 0,
                'remarks'       => $this->remarks
            ]);
            $this->js('notyf.success("'.__('Sirkulasi dibuat').'")'); 

            $item->is_active = true;
            $item->save();

            if ($this->is_immediate) {
                $msg = $circ->approve();
                $this->js('notyf.'.$msg[0].'("'.$msg[1].'")'); 
                if(isset($msg[2]) && isset($msg[3]))
                {
                    switch ($msg[2]) {
                        case 1:
                            $this->qty_main = $msg[3];
                            break;
                        case 2:
                            $this->qty_used = $msg[3];
                            break;
                        case 3:
                            $this->qty_rep = $msg[3];
                            break;                  
                    }
                }
            }

            if($this->qty < 0) {
                $item->updateFreq();
            }

            $this->dispatch('updated');
            $this->qtype = $this->qty_used || $this->qty_rep ? '' : 'main';
            $this->reset(['qty', 'remarks', 'user']);
        } else {
            $this->js('notyf.error("InvItem model not found")'); 
        }
    }

    public function updatedUser()
    {
        $this->dispatch('user-updated', $this->user);
    }
}
