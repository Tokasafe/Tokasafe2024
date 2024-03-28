<?php

namespace App\Http\Livewire\Manhours\ManhoursRegister;

use Livewire\Component;
use App\Models\Companies;
use App\Models\CompanyCategory;
use App\Models\Department;
use App\Models\GroupDepartment;
use App\Models\ManhoursRegister;

class Update extends Component
{
    
    public $openModal='',$data_id, $role_class,$label_dept, $company, $company_category, $category, $date, $manhour, $manpower, $dept_name, $dept, $group,$SelectCompany=[];
    protected $listeners = [
        'UpdateFileManhoursRegister',
    ];
    public function UpdateFileManhoursRegister($value)
    {
        if (!is_null($value)) {
            $this->data_id = $value;
            $ManhoursRegister = ManhoursRegister::where('id', $this->data_id)->first();
            $this->date =date('d-m-Y',strtotime($ManhoursRegister->date));
            $category_name =$ManhoursRegister->company_category;
           
            $this->company =$ManhoursRegister->company;
            $dept_name =$ManhoursRegister->dept;
            $this->role_class =$ManhoursRegister->role_class;
            $this->manhour =$ManhoursRegister->manhour;
            $this->manpower =$ManhoursRegister->manpower;
            $this->openModal = 'modal-open';
            if (!empty(CompanyCategory::where('name', $category_name)->first())) {
            $this->company_category = CompanyCategory::where('name', $category_name)->first()->id;
            }
           if ($dept_name) {
            
               $department_id = Department::where('name',$dept_name)->first()->id;
               $this->dept = GroupDepartment::where('department_id',$department_id)->first()->id;
           }
        }
    }
    public function render()
    {
        if ($this->company_category) {
            $this->SelectCompany = Companies::where('category_company', $this->company_category)->get();
            $this->category = CompanyCategory::whereId($this->company_category)->first()->name;
            if ($this->company_category==1) {
                $this->label_dept = 'department';
            } 
            else {
                $this->label_dept = 'Under_Departemen';
            }
            
        }
        else {
            $this->label_dept = 'department';
        }
        if ($this->dept) {
            $this->group = GroupDepartment::whereId($this->dept)->first()->Group->name;
            $this->dept_name = GroupDepartment::whereId($this->dept)->first()->Department->name;
        }
        return view('livewire.manhours.manhours-register.update',[
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
        ManhoursRegister::whereId($this->data_id)->update([
            'date' => date('Y-m-d', strtotime($this->date)),
            'company_category' => $this->category,
            'company' => $this->company,
            'dept' => $this->dept_name,
            'group' => $this->group,
            'role_class' => $this->role_class,
            'manhour' => $this->manhour,
            'manpower' => $this->manpower,
        ]);
        session()->flash('success', 'Data has been updated !!');
       
        $this->emit('AddManhoursRegister');
    }
    public function closeModal(){
        $this->openModal='';
    }
}
