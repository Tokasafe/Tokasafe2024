<?php

namespace App\Http\Livewire\Department;

use App\Models\Department;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;
    public $searchDepartment = '';
    public $nameData;
    public $IdData;
    protected $listeners = [

        'AddDepartment' => 'render',
        'UpdateDepartment' => 'render',
    ];
    public function render()
    {
        return view('livewire.department.index', [
            'Department' => Department::search(trim($this->searchDepartment))->orderBy('name')->paginate(5),
        ])->extends('navigation.homebase', ['header' => 'department'])->section('content');
    }
    public function update_Department($id)
    {
        $this->emit('DataUpdate', $id);
    }
    public function deleteFiles($id)
    {
        $this->IdData = $id;
        $this->nameData = Department::whereId($id)->first()->name;
    }
    public function deleteFile()
    {
        try {
            Department::find($this->IdData)->delete();
            session()->flash('success', "Department Deleted Successfully!!");

        } catch (\Exception $e) {
            session()->flash('error', "Something goes wrong!!");
        }
    }
    public function paginationView()
    {
        return 'livewire.pagination';
    }
}
