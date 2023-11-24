<?php

namespace App\Livewire;

use App\Models\InvLoc;
use Livewire\Component;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Gate;
use Illuminate\Database\Query\Builder;

class InvLocsEdit extends Component
{
    public InvLoc $loc;

    public $name = '';
    public $can_update = false;

    public function rules()
    {

        return [
            'name' => [
                'required', 'alpha_dash', 'min:1', 'max:20',
                Rule::unique('inv_locs')->where(fn (Builder $q) => $q->where('name', $this->name)->where('inv_area_id', $this->loc->inv_area_id))->ignore($this->loc->id)],
        ];
    }

    public function placeholder()
    {
        return view('livewire.modal-placeholder');
    }

    public function mount(InvLoc $loc)
    {
        $this->fill(
            $loc->only('name')
        );
    }

    public function render()
    {
        return view('livewire.inv-locs-edit');
    }

    public function update()
    {
        

        $this->name = strtoupper($this->name);
        $validated = $this->validate();
        
        $loc = InvLoc::find($this->loc->id);
        if ($loc) {
            Gate::authorize('manage', $loc);
            $loc->update($validated);
            $this->js('window.dispatchEvent(escKey)'); 
            $this->js('notyf.success("'.__('Lokasi diperbarui').'")'); 
            $this->dispatch('updated');
        }
    }

    public function delete()
    {
        // update: potential bug. Delete only when there is no inv_items using it

        $loc = InvLoc::find($this->loc->id);
        if ($loc) {
            Gate::authorize('manage', $loc);
            $loc->delete();
            $this->js('window.dispatchEvent(escKey)'); 
            $this->js('notyf.success("'.__('Lokasi dihapus').'")'); 
            $this->dispatch('updated');
        }
        
    }
}
