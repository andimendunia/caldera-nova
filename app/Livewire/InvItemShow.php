<?php

namespace App\Livewire;

use App\Models\User;
use App\Models\InvCirc;
use App\Models\InvCurr;
use App\Models\InvItem;
use Livewire\Component;
use Livewire\Attributes\On;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class InvItemShow extends Component
{
    public InvItem $inv_item;
    public InvCurr $inv_curr;

    public function mount()
    {
        $this->inv_curr = InvCurr::find(1);
    }

    #[On('updated')] 
    #[On('circ-updated')] 
    public function render()
    {
        $pending = InvCirc::where('inv_item_id', $this->inv_item->id)->where('status', 0)->count();
        $circMsg = $pending ? $pending.' '.__('tertunda') : __('Sirkulasi');
        $freq = (double)$this->inv_item->freq;
        if($freq > 0 && $freq < 1) {
            $freq = round((1/$freq), 2);
            $freqMsg = __('Diambil').' '.$freq.' '.$this->inv_item->inv_uom->name.' '.__('setiap hari');
        } elseif($freq > 1) {
            $freq = round($freq, 0);
            $freqMsg = __('Diambil 1').' '.$this->inv_item->inv_uom->name.' '.__('setiap').' '.$freq.' '.__('hari');
        } else {
            $freqMsg = __('Tak ada frekuensi ambil');
        }

        $loc = $this->inv_item->loc();
        $tags = $this->inv_item->tags();

        $user = User::find(Auth::user()->id);
        $invItemEval = $user->can('eval', $this->inv_item); 
        
        return view('livewire.inv-item-show', compact('loc', 'tags', 'circMsg', 'freqMsg', 'invItemEval'));
    }
}
