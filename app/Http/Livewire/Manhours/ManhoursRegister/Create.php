<?php

namespace App\Http\Livewire\Manhours\ManhoursRegister;

use App\Imports\ManhoursRegisterImport;
use Livewire\Component;
use App\Models\Companies;
use App\Models\DeptGroup;
use App\Models\CompanyCategory;
use App\Models\GroupDepartment;
use App\Models\ManhoursRegister;
use Livewire\WithFileUploads;
use Maatwebsite\Excel\Facades\Excel;

class Create extends Component
{
    use WithFileUploads;
    public $role_class,$label_dept, $company, $company_category, $category, $date, $manhour, $manpower, $dept_name, $dept, $group, $SelectCompany = [],$fileImport;
    public function render()
    {
        if ($this->company_category) {
            $this->SelectCompany = Companies::where('category_company', $this->company_category)->get();
            $this->category = CompanyCategory::whereId($this->company_category)->first()->name;
            if ($this->company_category==1) {
                $this->label_dept = 'department';
            } 
            else {
                $this->label_dept = 'Under Department';
            }
            
        }
        else {
            $this->label_dept = 'department';
        }
        if ($this->dept) {
            $this->group = GroupDepartment::whereId($this->dept)->first()->Group->name;
            $this->dept_name = GroupDepartment::whereId($this->dept)->first()->Department->name;
        }
        return view('livewire.manhours.manhours-register.create', [
            'KategoryCompany' => CompanyCategory::get(),
            'Company' => Companies::get(),
            'GroupCompany' => GroupDepartment::with(['Department', 'Group'])->get(),
        ]);
    }
    public function store()
    {
        $this->validate([
            'date' => 'required',
            'company_category' => 'required',
            'company' => 'required',
            'dept' => 'required',
            'role_class' => 'required',
            'manhour' => 'required',
            'manpower' => 'required',
        ]);
        ManhoursRegister::create([
            'date' => date('Y-m-d', strtotime($this->date)),
            'company_category' => $this->category,
            'company' => $this->company,
            'dept' => $this->dept_name,
            'group' => $this->group,
            'role_class' => $this->role_class,
            'manhour' => $this->manhour,
            'manpower' => $this->manpower,
        ]);
        session()->flash('success', 'Data added Successfully!!');
        $this->clearFields();
        $this->emit('AddManhoursRegister');
    }
    public function clearFields()
    {
        $this->manhour = '';
        $this->manpower = '';
    }
    public function uploadManhours(){
        $this->validate(['fileImport' => 'required']);
        Excel::import(new ManhoursRegisterImport,$this->fileImport);
        session()->flash('success', "importing file has done!!");
        $this->emit('AddManhoursRegister');
    }
}
