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

    public $role_class, $label_dept, $company, $company_category, $category, $date, $manhour, $manpower, $dept_name, $dept, $group,  $files,$showCompany='hidden';
    public function render()
    {
        $this->showPerusahaan();
        if ($this->company_category) {
            $this->category = CompanyCategory::whereId($this->company_category)->first()->name;
            if ($this->company_category == 1) {
                $this->label_dept = 'department';
            } else {
                $this->label_dept = 'Under Department';
            }
        } else {
            $this->label_dept = 'department';
        }
        if ($this->dept) {
            $this->group = GroupDepartment::whereId($this->dept)->first()->Group->name;
            $this->dept_name = GroupDepartment::whereId($this->dept)->first()->Department->name;
        }
        return view('livewire.manhours.manhours-register.create', [
            'KategoryCompany' => CompanyCategory::get(),
            'SelectCompany'=>Companies::searchcompany(trim($this->company))->where('category_company', $this->company_category)->orderBy('name', 'ASC')->get(),
            'Company' => Companies::orderBy('name', 'ASC')->get(),
            'GroupCompany' => GroupDepartment::with(['Department', 'Group'])->get(),
        ]);
    }
    public function showPerusahaan()
    {
        if (empty($this->company)) {
            $this->showCompany = 'hidden';
          
        } elseif (!Companies::caricompany(trim($this->company))->where('category_company', $this->company_category)->first()) {
            $this->showCompany = 'block';
        } else {
            $this->showCompany = 'hidden';
        }
    }
    public function cari_perusahaan($id)
    {
      
        if (!empty($id)) {
            $Perusahaan = Companies::whereId($id)->first();
            $this->company = $Perusahaan->name;
          
        }
    }
    public function uploadManhours()
    {

        $this->validate(['files' => 'required']);

        Excel::import(new ManhoursRegisterImport, $this->files);
        session()->flash('success', "importing file has done!!");
        $this->emit('AddManhoursRegister');
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
}
