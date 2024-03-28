<?php

namespace App\Http\Livewire\DepartmentGroup;

use App\Models\Department;
use App\Models\DeptGroup;
use App\Models\GroupDepartment;
use Livewire\Component;

class Create extends Component
{
    public $group_id;
    public $department_id;
    protected $messages = [
        'group_id' => 'the group field is required',
        'department_id' => 'the department field is required',
    ];
   
    public function render()
    {
        return view('livewire.department-group.create', [
            'Group' => DeptGroup::get(),
            'Department' => Department::get(),
        ]);
    }
    public function storeDeptGroup()
    {

        $this->validate([
            'group_id' => 'required',
            'department_id' => 'required',
        ]);

        GroupDepartment::create([
            'department_id' => $this->department_id,
            'group_id' => $this->group_id,
        ]);
        session()->flash('success', 'Data added Successfully!!');
        $this->clearFields();
        $this->emit('AddDeptGroup');
    }
    public function clearFields()
    {
        $this->group_id = '';
        $this->department_id = '';
    }
}
