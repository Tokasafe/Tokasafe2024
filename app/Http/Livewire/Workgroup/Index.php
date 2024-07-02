<?php

namespace App\Http\Livewire\Workgroup;

use App\Models\Workgroup;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    public $IdData;
    public $search='';
    public $companyLevel_id;
    public $bussinesUnit;
    public $role;
    use WithPagination;
    protected $listeners = [

        'AddWorkgroup' => 'render',
        'UpdateWorkgroup' => 'render',
    ];
    public function render()
    {
        return view('livewire.workgroup.index', [
            "Workgroup" => Workgroup::with([
                'CompanyLevel',
                'CompanyLevel.BussinessUnit',
            ])->searchWG(trim($this->search))->orderBy('created_at', 'DESC')->paginate(20),
        ])->extends('navigation.homebase', ['header' => 'Workgroup'])->section('content');
    }

    public function update_Workgroup($id)
    {

        $this->emit('updateWorkgroup', $id);
    }

    public function deleteWorkgroup($id)
    {
        $this->IdData = $id;
        $workgroup = Workgroup::whereId($id)->first();
        $this->companyLevel_id = $workgroup->CompanyLevel->departemen_contractor;
        $this->bussinesUnit = $workgroup->CompanyLevel->BussinessUnit->name;
        $this->role = $workgroup->job_class;
    }
    public function deleteFile()
    {
        try {
            Workgroup::find($this->IdData)->delete();
            session()->flash('success', " Deleted Successfully!!");
        } catch (\Exception $e) {
            session()->flash('error', "Something goes wrong!!");
        }
    }
    public function paginationView()
    {
        return 'livewire.pagination';
    }

}
