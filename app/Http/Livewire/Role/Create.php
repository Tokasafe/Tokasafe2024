<?php

namespace App\Http\Livewire\Role;

use App\Models\Role;
use App\Models\RoleClass;
use Livewire\Component;

class Create extends Component
{
    public $name;
    public $roleClass_id;
    public function render()
    {
        return view('livewire.role.create', [
            'RoleClass' => RoleClass::get(),
        ]);
    }
    public function store()
    {

        $this->validate([
            'roleClass_id' => 'required',
            'name' => 'required',
        ]);

        Role::create([
            'name' => $this->name,
            'roleClass_id' => $this->roleClass_id,
        ]);
        session()->flash('success', 'Data added Successfully!!');
        $this->clearFields();
        $this->emit('AddRole');
    }
    public function clearFields()
    {
        $this->roleClass_id = '';
        $this->name = '';
    }
}
