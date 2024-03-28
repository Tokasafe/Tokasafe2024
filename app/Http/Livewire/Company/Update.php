<?php

namespace App\Http\Livewire\Company;

use App\Models\Companies;
use App\Models\CompanyCategory;
use Livewire\Component;

class Update extends Component
{
    // use WithPagination;
    public $IdData;
    public $name;
    public $company_category_id;
    public $openModal = '';
    protected $listeners = [

        'ID_Company',
    ];
    public function ID_Company($value)
    {
        if (!is_null($value)) {
            $this->IdData = $value;
            $this->name = Companies::where('id', $this->IdData)->first()->name;
            $this->company_category_id = Companies::where('id', $this->IdData)->first()->category_company;
            $this->openModal = 'modal-open';
        }

    }
    public function render()
    {
        return view('livewire.company.update', [
            'CompanyCategory' => CompanyCategory::get(),
        ]);
    }
    public function store()
    {

        $this->validate([
            'name' => 'required',
            'company_category_id' => 'required',
        ]);
        try {
            Companies::whereId($this->IdData)->update([
                'name' => $this->name,
                'category_company' => $this->company_category_id,
            ]);
            session()->flash('success', 'Data Updated Successfully!!');
            $this->name = null;
        } catch (\Exception $ex) {
            session()->flash('success', 'Something goes wrong!!');
        }
        $this->emit('UpdateCompany');
        $this->clearFields();
    }
    public function clearFields()
    {
        $this->company_category_id = '';
        $this->name = '';
    }
    public function outModal()
    {
        $this->openModal = '';
    }
}
