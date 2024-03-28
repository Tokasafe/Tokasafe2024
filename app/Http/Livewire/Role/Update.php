<?php

namespace App\Http\Livewire\Role;

use App\Models\Role;
use App\Models\RoleClass;
use Livewire\Component;

class Update extends Component
{
    public $roleClass_id;
    public $name;
    public $data_id;
    public $openModal = '';
    protected $listeners = [

        'DataUpdate',
    ];
    public function DataUpdate($value)
    {
        if (!is_null($value)) {
            $this->data_id = $value;
            $role = Role::where('id', $this->data_id)->first();
            $this->name = $role->name;
            $this->roleClass_id = $role->roleClass_id;
            $this->openModal = 'modal-open';
        }
    }
    public function render()
    {
        return view('livewire.role.update', [
            'RoleClass' => RoleClass::get(),
        ]);
    }
    public function store()
    {

        $this->validate([
            'name' => 'required',
        ]);
        try {
            Role::whereId($this->data_id)->update([
                'name' => $this->name,
                'roleClass_id' => $this->roleClass_id,
            ]);
            session()->flash('success', 'Data Updated Successfully!!');
            $this->name = null;
        } catch (\Exception $ex) {
            session()->flash('success', 'Something goes wrong!!');
        }
        $this->emit('UpdateRole');
        $this->openModal = '';
    }
    public function clearFilds()
    {
        $this->name = '';
        $this->roleClass_id = '';
    }
    public function outModal()
    {
        $this->openModal = '';
    }
}
