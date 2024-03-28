<?php

namespace App\Http\Livewire\RoleClass;

use App\Models\RoleClass;
use Livewire\Component;

class Create extends Component
{
    public $name;
    public $description;
    public function render()
    {
        return view('livewire.role-class.create');
    }
    public function store()
    {

        $this->validate([
            'description' => 'required',
            'name' => 'required',
        ]);

        RoleClass::create([
            'name' => $this->name,
            'description' => $this->description,
        ]);
        session()->flash('success', 'Data added Successfully!!');
        $this->clearFields();
        $this->emit('AddRoleClass');
    }
    public function clearFields()
    {
        $this->description = '';
        $this->name = '';
    }
}
