<?php

namespace App\Http\Livewire\Company;

use App\Models\Companies;
use App\Models\CompanyCategory;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;
    public $IdData;
    public $search_category = '';
    public $searchCompany = '';
    public $nameData;
    protected $listeners = [

        'AddCompany' => 'render',
        'UpdateCompany' => 'render',
    ];
    public function render()
    {
        return view('livewire.company.index', [
            'Company' => Companies::with(['CompanyCategory'])->searchcategory(trim($this->search_category))->searchcompany(trim($this->searchCompany))->paginate(5),
            'CompanyCategory' => CompanyCategory::get(),
        ])->extends('navigation.homebase', ['header' => 'Company'])->section('content');
    }
    public function update_company($id)
    {
        $this->emit('ID_Company', $id);
    }
    public function deleteFiles($id)
    {
        $this->IdData = $id;
        $this->nameData = Companies::whereId($id)->first()->name;
    }
    public function deleteFile()
    {
        try {
            Companies::find($this->IdData)->delete();
            session()->flash('success', "Company Deleted Successfully!!");
        } catch (\Exception $e) {
            session()->flash('error', "Something goes wrong!!");
        }
    }
    public function paginationView()
    {
        return 'livewire.pagination';
    }
}
