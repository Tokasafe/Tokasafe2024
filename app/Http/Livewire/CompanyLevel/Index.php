<?php

namespace App\Http\Livewire\CompanyLevel;

use App\Models\Companies;
use App\Models\CompanyLevel;
use App\Models\Department;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;
    public $IdData;
    public $searchBU = '';
    public $searchDeptCont = '';
    public $searchLevel = '';
    public $bu_name;
    public $DeptCont = [];
    public $Dept = [];
    public $Cont = [];
    public $table_name = '';
    public $contractor_name;
    protected $listeners = [

        'AddCompanyLevel' => 'render',
        'UpdateCompanyLevel' => 'render',
    ];
    public function render()
    {
        if (!empty($this->searchLevel)) {
            if ($this->searchLevel === 'department') {
                $this->DeptCont = Department::get();
                $main = CompanyLevel::with(['BussinessUnit'])->where('level', $this->searchLevel)->bussinesunit(trim($this->searchBU))->deptcont($this->searchDeptCont)->paginate(5);
                $this->table_name = 'Department';
            } else {
                $this->DeptCont = Companies::where('category_company', 2)->get();
                $main = CompanyLevel::with(['BussinessUnit'])->where('level', $this->searchLevel)->bussinesunit(trim($this->searchBU))->deptcont($this->searchDeptCont)->paginate(5);
                $this->table_name = 'Contractor';
            }

        } else {
            $main = CompanyLevel::with(['BussinessUnit'])->bussinesunit(trim($this->searchBU))->deptcont($this->searchDeptCont)->paginate(5);
            $this->table_name = 'Department / Contractor';
            $this->Dept = Department::get();
            $this->Cont = Companies::where('category_company', 2)->get();

        }
        return view('livewire.company-level.index', [
            'B_unit' => Companies::where('category_company', 1)->get(),
            'Contractor' => Companies::where('category_company', 2)->get(),
            'CompanyLevel' => $main,
        ])->extends('navigation.homebase', ['header' => 'company level'])->section('content');
    }
    public function update_CompanyLevel($id)
    {

        $this->emit('ID_CompanyLevel', $id);

    }
    public function deleteCompanyLevel($id)
    {
        $this->IdData = $id;
        $this->bu_name = CompanyLevel::whereId($id)->first()->BussinessUnit->name;
        $this->contractor_name = CompanyLevel::whereId($id)->first()->Contractor->name;
    }
    public function deleteFileCompanyLevel()
    {
        try {
            CompanyLevel::find($this->IdData)->delete();
            session()->flash('success', "Company Level Deleted Successfully!!");
        } catch (\Exception $e) {
            session()->flash('error', "Something goes wrong!!");
        }
    }
    public function paginationView()
    {
        return 'livewire.pagination';
    }
}
