<?php

namespace App\Http\Livewire\CompanyLevel;

use App\Models\Companies;
use App\Models\CompanyLevel;
use App\Models\Department;
use Livewire\Component;

class Update extends Component
{
    public $IdData;
    public $bussiness_unit;
    public $dept_or_group;
    public $BussinessUnit = [];
    public $Option = [];
    public $LabelOption;
    public $level;
    public $openModal = '';
    protected $listeners = [

        'ID_CompanyLevel',
    ];
    public function ID_CompanyLevel($value)
    {
        if (!is_null($value)) {
            $this->IdData = $value;
            $this->bussiness_unit = CompanyLevel::where('id', $this->IdData)->first()->bussiness_unit;
            $this->dept_or_group = CompanyLevel::where('id', $this->IdData)->first()->deptORcont;
            $this->level = CompanyLevel::where('id', $this->IdData)->first()->level;
            $this->openModal = 'modal-open';
        }
    }
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
        return view('livewire.company-level.update', [
            'BussinessUnit' => Companies::where('category_company', 1)->get(),
            'Contractor' => Companies::where('category_company', 2)->get(),
        ]);
    }
    public function store()
    {
        $this->validate([
            'bussiness_unit' => 'required',
            'dept_or_group' => 'required',
            'level' => 'required',
        ]);
        try {
            CompanyLevel::whereId($this->IdData)->update([
                'bussiness_unit' => $this->bussiness_unit,
                'deptORcont' => $this->dept_or_group,
                'level' => $this->level,
            ]);
            session()->flash('success', 'Data Updated Successfully!!');
        } catch (\Exception $ex) {
            session()->flash('success', 'Something goes wrong!!');
        }
        $this->emit('UpdateCompanyLevel');
    }
    public function clearFields()
    {
        $this->contractor = '';
        $this->bussiness_unit = '';
    }
    public function outModal()
    {
        $this->openModal = '';
    }
}
