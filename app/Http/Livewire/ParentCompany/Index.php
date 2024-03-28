<?php

namespace App\Http\Livewire\ParentCompany;

use App\Models\CompanyCategory;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    public $search = '';
    public $nameData;
    public $IdData;
    protected $listeners = [

        'AddPC' => 'render',
        'UpdatePC' => 'render',
    ];
    public function render()
    {

        return view('livewire.parent-company.index', [
            'CompanyCategory' => CompanyCategory::search(trim($this->search))->paginate(5),
        ])->extends('navigation.homebase', ['header' => 'category company'])->section('content');
    }
    public function update_Company($id)
    {
        $this->emit('DataUpdate', $id);
    }
    public function deleteFiles($id)
    {
        $this->IdData = $id;
        $this->nameData = CompanyCategory::whereId($id)->first()->name;
    }
    public function deleteFile()
    {
        try {
            CompanyCategory::find($this->IdData)->delete();
            session()->flash('success', "Company Category Deleted Successfully!!");
        } catch (\Exception $e) {
            session()->flash('error', "Something goes wrong!!");
        }
    }
    public function paginationView()
    {
        return 'livewire.pagination';
    }
}
