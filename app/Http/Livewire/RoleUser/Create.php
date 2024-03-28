<?php

namespace App\Http\Livewire\RoleUser;

use App\Models\Roles;
use Livewire\Component;

class Create extends Component
{
    public $name;
    public function render()
    {
        return view('livewire.role-user.create');
    }
    public function store(){
        $this->validate([
            'name'=>'required'
        ]);
        Roles::create([
            'name' => $this->name,
        ]);
        session()->flash('success', 'Data added Successfully!!');
        $this->emit('AddRoleUsers');
    }
}
