<?php

namespace App\Http\Livewire\Company;

use Livewire\Component;
use App\Models\Companies;
use Livewire\WithFileUploads;
use App\Imports\CompanyImport;
use App\Models\CompanyCategory;
use Maatwebsite\Excel\Facades\Excel;

class Create extends Component
{
    public $company_category_id;
    public $fileImport;
    public $name;
    use WithFileUploads;
    public function render()
    {
        return view('livewire.company.create', [
            'CompanyCategory' => CompanyCategory::get(),
        ]);
    }
    public function uploadCompanies(){
        $this->validate(['fileImport' => 'required']);
        Excel::import(new CompanyImport,$this->fileImport);
        session()->flash('success', "importing file has done!!");
    }
    public function storeCompany()
    {

        $this->validate([
            'company_category_id' => 'required',
            'name' => 'required',
        ]);

        Companies::create([
            'name' => $this->name,
            'category_company' => $this->company_category_id,
        ]);
        session()->flash('success', 'Data added Successfully!!');
        $this->clearFields();
        $this->emit('AddCompany');
    }
    public function clearFields()
    {
        $this->company_category_id = '';
        $this->name = '';
    }
}
