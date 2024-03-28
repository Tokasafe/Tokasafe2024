<?php

namespace App\Http\Livewire\CompanyLevel;

use App\Models\Companies;
use App\Models\CompanyLevel;
use App\Models\Department;
use Livewire\Component;

class Create extends Component
{
    public $bussiness_unit;
    public $dept_or_group;
    public $BussinessUnit = [];
    public $Option = [];
    public $LabelOption;
    public $level;
    protected $messages = [
        'bussiness_unit' => 'the bussiness unit field is required',
        'dept_or_group' => 'the field is required',
    ];
    public function render()
    {
        $this->BussinessUnit = Companies::where('category_company', 1)->get();
        if ($this->level === 'department') {
            $this->Option = Department::get();
            $this->LabelOption = 'Department';
        } else {

            $this->Option = Companies::where('category_company', 2)->get();
            $this->LabelOption = 'Contractor';
        }
        return view('livewire.company-level.create', [
        ]);
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
            'deptORcont' => $this->dept_or_group,
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
