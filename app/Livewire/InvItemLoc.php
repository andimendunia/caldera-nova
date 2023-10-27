<?php

namespace App\Livewire;

use App\Models\InvLoc;
use App\Models\InvItem;
use Livewire\Component;
use Livewire\Attributes\On;
use Illuminate\Support\Facades\Validator;

class InvItemLoc extends Component
{
    public $inv_area_id;

    public $isForm = false;

    public $id;
    public $loc;
    public $qlocs = [];

    public function rules()
    {

        return [
            'loc' => ['nullable', 'alpha_dash', 'max:20'],
        ];
    }

    public function messages() 
    {
        return [
            'loc.alpha_dash' => __('Hanya huruf, angka, dan strip'),
            'loc.max' => __('Maksimal 20 karakter'),
        ];
    }

    public function placeholder()
    {
        return view('livewire.modal-placeholder');
    }

    #[On('updated')]
    public function mount()
    {
        $item = InvItem::find($this->id);
        if($item) {
            $this->loc = $item->loc();
        }
    }

    public function updatedLoc()
    {
        $qloc = '%'.$this->loc.'%';
        $qlocs = InvLoc::where('inv_area_id', $this->inv_area_id)
        ->where('name', 'LIKE', $qloc)
        ->orderBy('name')
        ->take(100)
        ->get()
        ->pluck('name');
        $this->qlocs = $qlocs->toArray();

        if ($this->isForm) {
            $this->dispatch('loc-applied', loc: $this->loc);
        }
    }

    public function apply()
    {
        if ($this->isForm) {
            $this->dispatch('loc-applied', loc: $this->loc);
        } else {
            $this->validate();
            $item = InvItem::find($this->id);
            if($item) {
                $item->updateLoc($this->loc);
                $this->js('window.dispatchEvent(escKey)'); 
                $this->js('notyf.success("'.__('Lokasi diperbarui').'")');
                $this->dispatch('updated');
            }
        }
    }
}
