<?php

namespace App\Livewire;

use App\Models\User;
use App\Models\InvArea;
use App\Models\InvItem;
use Livewire\Component;
use Livewire\Attributes\Rule;
use Illuminate\Support\Facades\Auth;

class InvFirst extends Component
{
    public $code;
    public $areas;

    #[Rule('required')]
    public $inv_area_id;

    public function placeholder()
    {
        return view('livewire.modal-placeholder');
    }

    public function mount()
    {
        $user = User::find(Auth::user()->id);
        $this->areas = InvArea::whereIn('id', $user->invAreaIdsCreate())->get();
    }

    public function render()
    {
        return view('livewire.inv-first');
    }

    public function first()
    {
        $this->code = strtoupper(trim($this->code));
        $this->validate();

        $item = $this->code ? $item = InvItem::where('inv_area_id', $this->inv_area_id)->where('code', $this->code)->first() : '';

        if ($item)
        {
            return redirect(route('inventory.items.show', [ 'id' => $item->id ]));
        } else {
            return redirect(route('inventory.items.create', [ 'inv_area_id' => $this->inv_area_id, 'code' => $this->code ]));
        }        

    }
}
