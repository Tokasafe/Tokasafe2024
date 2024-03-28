<?php

namespace App\Http\Livewire\AdminControlCompanyManhours;

use App\Models\AdminControlCompanyManhours;
use Livewire\Component;
use App\Models\Companies;
use App\Models\User;

class Index extends Component
{
    public $searchUser = "", $searchCompany, $id_ACCM, $user_id, $company_id;
    protected $listeners = [

        'AddAdminControlCompanyManhours' => 'render',
    ];
    public function render()
    {
        return view('livewire.admin-control-company-manhours.index', [
            'Company' => Companies::get(),
            'User' => User::with(['companies','Roles'])->SearchUsers(trim($this->searchUser))->searchcompany(trim($this->searchCompany))->paginate(10),
        ])->extends('navigation.homebase', ['header' => 'Control Company Manhours'])->section('content');
    }
    public function update_company($id, $company)
    {
        $this->id_ACCM = AdminControlCompanyManhours::where('user_id', $id)->where('companies_id', $company)->first()->id;
        $this->user_id = $id;
        $this->company_id =$company;
    }
    public function update(){
        $this->validate([
            'user_id' => 'required',
            'company_id' => 'required',
        ]);
        try {
            AdminControlCompanyManhours::whereId($this->id_ACCM)->update([
                'user_id' => $this->user_id,
                'companies_id' => $this->company_id,
            ]);
            session()->flash('success', 'Data Updated Successfully!!');
            $this->user_id = null;
            $this->company_id = null;
        } catch (\Exception $ex) {
            session()->flash('success', 'Something goes wrong!!');
        }
    }

    public function deleteFile()
    {
        try {
            AdminControlCompanyManhours::find($this->id_ACCM)->delete();
            session()->flash('success', "Company Deleted Successfully!!");
        } catch (\Exception $e) {
            session()->flash('error', "Something goes wrong!!");
        }
    }
}
