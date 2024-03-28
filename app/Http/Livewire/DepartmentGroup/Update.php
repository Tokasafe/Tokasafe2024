<?php

namespace App\Http\Livewire\DepartmentGroup;

use App\Models\Department;
use App\Models\DeptGroup;
use App\Models\GroupDepartment;
use Livewire\Component;

class Update extends Component
{
    public $IdData;
    public $department_id;
    public $group_id;
    public $openModal = '';
    protected $listeners = [

        'ID_DG',
    ];
    public function ID_DG($value)
    {
        if (!is_null($value)) {
            $this->IdData = $value;
            $this->department_id = GroupDepartment::where('id', $this->IdData)->first()->department_id;
            $this->group_id = GroupDepartment::where('id', $this->IdData)->first()->group_id;
            $this->openModal = 'modal-open';
        }

    }
    public function render()
    {
        return view('livewire.department-group.update', [
            'Group' => DeptGroup::get(),
            'Department' => Department::get(),
        ]);
    }
    public function store()
    {

        $this->validate([
            'department_id' => 'required',
            'group_id' => 'required',
        ]);
        try {
            GroupDepartment::whereId($this->IdData)->update([
                'department_id' => $this->department_id,
                'group_id' => $this->group_id,
            ]);
            session()->flash('success', 'Data Updated Successfully!!');
            $this->department_id = null;
        } catch (\Exception $ex) {
            session()->flash('success', 'Something goes wrong!!');
        }
        $this->emit('UpdateDeptGroup');
        $this->clearFields();
    }
    public function clearFields()
    {
        $this->group_id = '';
        $this->department_id = '';
    }
    public function outModal()
    {
        $this->openModal = '';
    }
}
