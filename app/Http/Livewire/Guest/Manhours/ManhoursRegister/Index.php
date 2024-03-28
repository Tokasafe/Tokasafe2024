<?php

namespace App\Http\Livewire\Guest\Manhours\ManhoursRegister;

use App\Models\People;
use Livewire\Component;
use App\Models\Companies;
use App\Models\Department;
use Livewire\WithPagination;
use App\Models\CompanyCategory;
use App\Models\ManhoursRegister;
use App\Models\AdminControlCompanyManhours;

class Index extends Component
{
    use WithPagination;
    public $IdData,$code,$company,$job_class,$searchCompany='',$searchDateRange="",$tglMulai,$endDate,$show=false,$namecompanies;
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
        if (auth()->user()->role_users_id==2) {
            $employer =  People::where('network_username',auth()->user()->username)->first()->employer;
          
            if ($employer) {
                $this->show=true;
            } else {
            $this->show =false;
            }
          } 

        if (empty($this->searchDateRange)) {
            if (!empty(ManhoursRegister::orderby('date', 'asc')->first()->date)) {
                $this->tglMulai = ManhoursRegister::orderby('date', 'asc')->first()->date;
                $this->endDate = ManhoursRegister::orderby('date', 'desc')->first()->date;
            }
            else{
                $this->tglMulai="";
                $this->endDate="";
            }
            $companies = AdminControlCompanyManhours::where('user_id',auth()->user()->id)->pluck('companies_id');
            $this->namecompanies = Companies::whereIn('id',$companies)->pluck('name');
           
        }
        return view('livewire.guest.manhours.manhours-register.index',[
            'Company'=>Companies::whereIn('name', $this->namecompanies)->get(),
            'Dept'=>Department::get(),
            'CompanyCategory'=>CompanyCategory::get(),
            'ManhoursRegister'=> ManhoursRegister::company(trim($this->searchCompany))->dateRange([trim($this->tglMulai), trim($this->endDate)])->whereIn('company',$this->namecompanies)->orderBy('date','DESC')->orderBy('company','DESC')->paginate(20)
        ])->extends('navigation.guest.guestbase', ['header' => 'Manhours Register'])->section('contentUser');
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
}
