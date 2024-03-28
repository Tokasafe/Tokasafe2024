<?php

namespace App\Http\Livewire\Workgroup;

use App\Models\CompanyLevel;
use App\Models\Workgroup;
use Livewire\Component;

class Update extends Component
{
    public $companyLevel_id;
    public $role;
    public $level = '';
    public $data_id;
    public $openModal = '';
    protected $listeners = [

        'updateWorkgroup',
    ];
    public function updateWorkgroup($value)
    {
        if (!is_null($value)) {
            $this->data_id = $value;
            $this->level = Workgroup::where('id', $this->data_id)->first()->CompanyLevel->level;
            $Workgroup = Workgroup::where('id', $this->data_id)->first();
            $this->companyLevel_id = $Workgroup->companyLevel_id;
            $this->role = $Workgroup->job_class;

            $this->openModal = 'modal-open';
        }
    }
    public function clearFields()
    {
        $this->companyLevel_id = '';
        $this->role = '';
        $this->level = '';
    }
    public function render()
    {
        return view('livewire.workgroup.update', [
            'CompanyLevel' => CompanyLevel::where('level', $this->level)->get(),
        ]);
    }
    public function store()
    {

        $this->validate([
            'companyLevel_id' => 'required',
            'role' => 'required',
        ]);
        try {
            Workgroup::whereId($this->data_id)->update([
                'companyLevel_id' => $this->companyLevel_id,
                'job_class' => $this->role,
            ]);
            session()->flash('success', 'Data Updated Successfully!!');
            $this->clearFields();
        } catch (\Exception $ex) {
            session()->flash('success', 'Something goes wrong!!');
        }
        $this->emit('UpdateWorkgroup');
        $this->openModal = '';
    }
    public function outModal()
    {
        $this->openModal = '';
    }
}
