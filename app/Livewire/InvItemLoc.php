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
            $validator = Validator::make(
                ['loc' => $this->loc ],
                ['loc' => 'nullable|alpha_dash|max:20'],
                ['alpha_dash' => __('Hanya boleh mengandung huruf, angka, dan strip'), 'max' => __('Maksimal 20 karakter')]
            );

            if ($validator->fails()) {

                $errors = $validator->errors();
                $error = $errors->first('loc');
                $this->js('notyf.error("'.$error.'")'); 

            } else {
                $item = InvItem::find($this->id);
                if($item) {
                    if ($item->loc() !== $this->loc) {
                        $item->updateLoc($this->loc);
                        $this->js('notyf.success("'.__('Lokasi diperbarui').'")');
                        $this->dispatch('updated');
                    }
                }
            }

        }
    }
}
