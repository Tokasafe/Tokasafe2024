<?php

namespace App\Http\Livewire\DepartmentGroup;

use App\Models\Department;
use App\Models\DeptGroup;
use App\Models\GroupDepartment;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;
    public $IdData;
    public $searchGroup = '';
    public $searchDepartment = '';
    public $dept_name;
    public $group_name;
    protected $listeners = [

        'AddDeptGroup' => 'render',
        'UpdateDeptGroup' => 'render',
    ];
    public function render()
    {
        return view('livewire.department-group.index', [
            "DeptGroup" => GroupDepartment::with(['Group', 'Department'])->search(trim($this->searchDepartment))->group(trim($this->searchGroup))->paginate(5),
            'Group' => DeptGroup::get(),
            'Department' => Department::get(),
        ])->extends('navigation.homebase', ['header' => 'Department Group'])->section('content');
    }
    public function update_DepartmentGroup($id)
    {
        $this->emit('ID_DG', $id);
    }
    public function deleteDepartmentGroup($id)
    {
        $this->IdData = $id;
        $this->dept_name = GroupDepartment::whereId($id)->first()->Department->name;
        $this->group_name = GroupDepartment::whereId($id)->first()->Group->name;
    }
    public function deleteFileDeptGroup()
    {
        try {
            GroupDepartment::find($this->IdData)->delete();
            session()->flash('success', "Dept. Group Deleted Successfully!!");
        } catch (\Exception $e) {
            session()->flash('error', "Something goes wrong!!");
        }
    }
    public function paginationView()
    {
        return 'livewire.pagination';
    }
}
