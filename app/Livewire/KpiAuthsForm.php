<?php

namespace App\Livewire;

use App\Models\User;
use App\Models\KpiArea;
use App\Models\KpiAuth;
use Livewire\Component;
use Livewire\Attributes\Renderless;
use Illuminate\Support\Facades\Gate;

class KpiAuthsForm extends Component
{
    public KpiAuth $auth;
    public $auth_id = '';

    public $userq;
    public $user_id;


    public $area_id;
    public $actions = [];

    public $areas;

    public $is_superuser = false;

    public function rules()
    {
        return [
            'user_id'   => ['required', 'integer', 'exists:App\Models\User,id'],
            'area_id'   => ['required', 'integer', 'exists:App\Models\KpiArea,id'],
        ];
    }

    // public function messages()
    // {
    //     return [
    //         'user_id.exists' => __('Tag hanya boleh berisi huruf, angka, dan strip')
    //     ];
    // }

    public function placeholder()
    {
        return view('livewire.modal-placeholder');
    }

    public function mount(KpiAuth $auth)
    {
        if ($auth->id) {
            $this->auth_id = $auth->id;
            $this->userq = $auth->user->emp_id;
            $this->area_id = $auth->kpi_area_id;
            $this->actions = json_decode($auth->actions, true);
        }
        $this->is_superuser = Gate::allows('superuser');

        $this->areas = KpiArea::all();
    }

    public function render()
    {
        return view('livewire.kpi-auths-form');
    }

    public function save()
    {
        Gate::authorize('superuser');
       
        $this->userq = trim($this->userq);
        // delegate to...
        if ($this->userq) {
            $user = User::where('emp_id', $this->userq)->first();
            
            $this->user_id = $user ? $user->id : '';
        }
        // VALIDATE 

        $this->validate();

        if ($this->user_id == 1) {
            
            $this->js('notyf.error("'.__('Superuser sudah memiliki wewenang penuh').'")'); 
        } else {
            $auth = KpiAuth::updateOrCreate(
                ['user_id' => $this->user_id, 'kpi_area_id' => $this->area_id],
                ['actions' => json_encode($this->actions)]
            ); 
            $this->js('notyf.success("'.__('Wewenang diperbarui').'")'); 
            $this->dispatch('updated');
        }

        !$this->auth_id ? $this->reset(['userq', 'user_id', 'area_id', 'actions']) : false;

        $this->js('window.dispatchEvent(escKey)'); 
    }

    public function delete()
    {
        $this->auth->delete();
        $this->js('window.dispatchEvent(escKey)'); 
        $this->js('notyf.success("'.__('Wewenang dicabut').'")'); 
        $this->dispatch('updated');
    }
    
    #[Renderless]
    public function updatedUserq()
    {
        $this->dispatch('userq-updated', $this->userq);
    }
}
