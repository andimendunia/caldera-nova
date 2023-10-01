<?php

namespace App\Livewire;

use App\Models\InvCurr;
use Livewire\Component;
use Illuminate\Validation\Rule;

class InvCurrsEdit extends Component
{
    public InvCurr $curr;
    
    public $name = '';
    public $rate = '';

    public function rules()
    {
        return [
            'name' => ['required', 'alpha:ascii', 'size:3', Rule::unique('inv_currs')->ignore($this->curr->id)],
            'rate' => 'required|numeric|min:1|max:100000'
        ];
    }

    public function placeholder()
    {
        return view('livewire.modal-placeholder');
    }

    public function mount(InvCurr $curr)
    {
        $this->fill(
            $curr->only('name', 'rate')
        );
    }

    public function render()
    {
        return view('livewire.inv-currs-edit');
    }

    public function update()
    {
        $this->name = strtoupper($this->name);
        $validated = $this->validate();

        $curr = InvCurr::find($this->curr->id);
        if ($curr) {
            if($curr->id == 1 && $this->rate != 1) {
                
            } else {
                $curr->update($validated); 
                $this->js('window.dispatchEvent(escKey)'); 
                $this->js('notyf.success("'.__('Mata uang diperbarui').'")'); 
                $this->dispatch('updated');
            }
        }
    }

    public function delete()
    {
        // update: potential bug. Delete only when there is no inv_items using it

        $curr = InvCurr::find($this->curr->id);
        if ($curr) {
            $id = $curr->id;
            if($id != 1) {
                $curr->delete();
                $this->js('window.dispatchEvent(escKey)'); 
                $this->js('notyf.success("'.__('Mata uang dihapus').'")'); 
                $this->dispatch('updated');
            }
        }

    }
}
