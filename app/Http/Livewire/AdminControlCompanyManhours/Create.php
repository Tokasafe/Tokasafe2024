<?php

namespace App\Http\Livewire\AdminControlCompanyManhours;

use App\Models\AdminControlCompanyManhours;
use App\Models\User;
use Livewire\Component;
use App\Models\Companies;

class Create extends Component
{
    public $user_id,$company_id;
    public function render()
    {
        return view('livewire.admin-control-company-manhours.create',[
            'Company'=>Companies::get(),
            'User'=>User::get(),
        ]);
    }
    public function store()
    {

        $this->validate([
            'user_id' => 'required',
            'company_id' => 'required',
        ]);

        AdminControlCompanyManhours::create([
            'user_id' => $this->user_id,
            'companies_id' => $this->company_id,
        ]);
        session()->flash('success', 'Data added Successfully!!');
        $this->clearFields();
        $this->emit('AddAdminControlCompanyManhours');
    }
    public function clearFields()
    {
        $this->user_id = '';
        $this->company_id = '';
    }
}
