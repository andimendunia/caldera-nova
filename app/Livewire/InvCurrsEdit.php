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
            'name' => ['required', 'alpha:ascii', 'size:3', Rule::unique('inv_currs')->ignore($this->curr->id),],
            'rate' => 'required|numeric|min:1|max:100000'
        ];
    }

    public function placeholder()
    {
        return view('livewire.modal-placeholder');
    }

    public function mount(InvCurr $curr)
    {
        $this->curr = $curr;
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

        $id = $this->curr->id;
        if($id == 1 && $this->rate !== 1) {
            
        } else {
            $curr = InvCurr::findOrFail($id);
            $curr->update($validated); 
        }
        $this->dispatch('curr-updated');

    }
}
