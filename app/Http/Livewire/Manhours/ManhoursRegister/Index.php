<?php

namespace App\Http\Livewire\Manhours\ManhoursRegister;

use App\Exports\ManhoursExport;
use App\Models\AdminControlCompanyManhours;
use App\Models\Companies;
use App\Models\CompanyCategory;
use App\Models\Department;
use App\Models\ManhoursRegister;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;
    public $IdData,$code,$company,$job_class,$searchCompany='',$searchCompanyCategory='',$searchDept='',$searchDateRange='',$tglMulai,$endDate,$selectAll=false,$selectedManhours=[],$bulkDisable = true;
    protected $listeners = [
        'TglMulai_m',
        'TglAkhir_m',
        'AddManhoursRegister' => 'render',
        'UpdateManhoursRegister' => 'render',
    ];
    public function TglMulai_m($value)
    {
        if (!is_null($value)) {
            $this->tglMulai = date('Y-m-d', strtotime($value));
        }
    }
    public function TglAkhir_m($value)
    {
        if (!is_null($value)) {

            $this->endDate = date('Y-m-d', strtotime($value));
           
        }
    }
    public function render()
    {
       
        $this->bulkDisable = count($this->selectedManhours) < 2;
        if (empty($this->searchDateRange)) {
            if (!empty(ManhoursRegister::orderby('date', 'asc')->first()->date)) {
                $this->tglMulai = ManhoursRegister::orderby('date', 'asc')->first()->date;
                $this->endDate = ManhoursRegister::orderby('date', 'desc')->first()->date;
            }
            else{
                $this->tglMulai="";
                $this->endDate="";
            }
        }
       
          
            $MR =ManhoursRegister::company(trim($this->searchCompany))->companyCategory(trim($this->searchCompanyCategory))->dept(trim($this->searchDept))->dateRange([trim($this->tglMulai), trim($this->endDate)])->orderBy('date','DESC')->orderBy('company','DESC')->paginate(20);
        
        return view('livewire.manhours.manhours-register.index',[
            'Company'=>Companies::get(),
            'Dept'=>Department::get(),
            'CompanyCategory'=>CompanyCategory::get(),
            'ManhoursRegister'=>  $MR
        ])->extends('navigation.homebase', ['header' => 'Manhours Register'])->section('content');
    }
    public function update($id)
    {
        $this->emit('UpdateFileManhoursRegister', $id);
    }
    public function delete($id)
    {
        $this->IdData = $id;
        $this->company = ManhoursRegister::whereId($id)->first()->company;
        $this->job_class = ManhoursRegister::whereId($id)->first()->role_class;
    }
    public function deleteFile()
    {
        try {
            ManhoursRegister::find($this->IdData)->delete();
            session()->flash('success', "Data Deleted Successfully!!");
        } catch (\Exception $e) {
            session()->flash('error', "Something goes wrong!!");
        }
    }
    public function paginationView()
    {
        return 'livewire.pagination';
    }
    public function updatedSelectAll($value)
    {
        $main =ManhoursRegister::company(trim($this->searchCompany))->companyCategory(trim($this->searchCompanyCategory))->dept(trim($this->searchDept))->dateRange([trim($this->tglMulai), trim($this->endDate)])->pluck('id');
        if ($value) {
            $this->selectedManhours = $main;
          
        } else {
            $this->selectedManhours = [];
        }
    }

    public function export()
    {
        if ($this->searchCompany) {
            $company = $this->searchCompany;
        } else {
           $company ="List Manhours";
        }
        
        return (new ManhoursExport($this->selectedManhours))->download("$company.csv");
    }

}
