<?php

namespace App\Http\Livewire\CompanyLevel;

use Livewire\Component;
use App\Models\Companies;
use App\Models\Department;
use App\Models\CompanyLevel;
use App\Imports\CompanyLevelImport;
use Livewire\WithFileUploads;
use Maatwebsite\Excel\Facades\Excel;

class Create extends Component
{
    use WithFileUploads;
    public $bussiness_unit;
    public $fileImport;
    public $dept_or_group;
    public $BussinessUnit = [];
    public $Option = [];
    public $LabelOption;
    public $level ='department';
    protected $messages = [
        'bussiness_unit' => 'the bussiness unit field is required',
        'dept_or_group' => 'the field is required',
    ];
    public function render()
    {
        $this->BussinessUnit = Companies::where('category_company', 1)->orderBy('name','asc')->get();
        if ($this->level === 'department') {
            $this->Option = Department::get();
            $this->LabelOption = 'Department';
        } elseif ($this->level === 'contractor') {
          
            $this->Option = Companies::where('category_company', 2)->orderBy('name','asc')->get();
            $this->LabelOption = 'Contractor';
        } else {
            $this->LabelOption = 'an Options';
        }
        
        
       
        return view('livewire.company-level.create', [
        ]);
    }
    public function uploadCompanies(){
        $this->validate(['fileImport' => 'required']);
        Excel::import(new CompanyLevelImport,$this->fileImport);
        $this->emit('importCompanyLevel');
        session()->flash('success', "importing file has done!!");
    }
    public function storeCompanyLevel()
    {

        

        $this->validate([
            'dept_or_group' => 'required',
            'bussiness_unit' => 'required',
            'level' => 'required',
        ]);
        
        CompanyLevel::create([
            'bussiness_unit' => $this->bussiness_unit,
            'departemen_contractor' => $this->dept_or_group,
            'level' => $this->level,
        ]);
        session()->flash('success', 'Data added Successfully!!');
        $this->clearFields();
        $this->emit('AddCompanyLevel');
    }
    public function clearFields()
    {
        $this->dept_or_group = '';
        // $this->bussiness_unit = '';
    }
}
