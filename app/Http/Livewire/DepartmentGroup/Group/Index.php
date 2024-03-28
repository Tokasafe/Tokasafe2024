<?php

namespace App\Http\Livewire\DepartmentGroup\Group;

use App\Models\DeptGroup;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    public $search = '';
    public $nameData;
    public $IdData;
    protected $listeners = [

        'AddGroupDept' => 'render',
        'UpdateGroupDept' => 'render',
    ];
    public function render()
    {
        return view('livewire.department-group.group.index', [
            "Group" => DeptGroup::search(trim($this->search))->orderBy('name', 'ASC')->paginate(5),
        ]);
    }
    public function update_Group($id)
    {
        $this->emit('DataUpdate', $id);
    }
    public function deleteGroup($id)
    {
        $this->IdData = $id;
        $this->nameData = DeptGroup::whereId($id)->first()->name;
    }
    public function deleteFile()
    {
        try {
            DeptGroup::find($this->IdData)->delete();
            session()->flash('success', "Group Deleted Successfully!!");
        } catch (\Exception $e) {
            session()->flash('error', "Something goes wrong!!");
        }
    }
    public function paginationView()
    {
        return 'livewire.pagination';
    }
}
