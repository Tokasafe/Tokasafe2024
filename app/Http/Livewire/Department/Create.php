<?php

namespace App\Http\Livewire\Department;

use Livewire\Component;
use App\Models\Department;
use Maatwebsite\Excel\Facades\Excel;
use Livewire\WithFileUploads;
use App\Imports\DepartmentImport;

class Create extends Component
{
    public $name,$fileImport;
    use WithFileUploads;
    public function render()
    {
        return view('livewire.department.create');
    }
    public function store()
    {

        $this->validate([
            'name' => 'required',
        ]);
        Department::create([
            'name' => $this->name,
        ]);
        $this->emit('AddDepartment');
        $this->name = null;
        session()->flash('success', 'Department has been added!!!');
    }
    public function uploadDept(){
        $this->validate(['fileImport' => 'required']);
        Excel::import(new DepartmentImport,$this->fileImport);
        session()->flash('success', "importing file has done!!");
        $this->emit('AddDepartment');
    }
}
