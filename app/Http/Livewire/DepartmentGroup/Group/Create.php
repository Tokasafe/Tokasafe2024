<?php

namespace App\Http\Livewire\DepartmentGroup\Group;

use App\Models\DeptGroup;
use Livewire\Component;

class Create extends Component
{
    public $name;
    public function render()
    {
        return view('livewire.department-group.group.create');
    }
    public function store()
    {

        $this->validate([
            'name' => 'required',
        ]);
        DeptGroup::create([
            'name' => $this->name,
        ]);
        $this->emit('AddGroupDept');
        $this->name = null;
        session()->flash('success', 'Group has been added!!!');
    }
}
