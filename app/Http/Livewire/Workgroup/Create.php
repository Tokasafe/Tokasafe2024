<?php

namespace App\Http\Livewire\Workgroup;

use App\Models\CompanyLevel;
use App\Models\Workgroup;
use Livewire\Component;

class Create extends Component
{
    public $companyLevel_id;
    public $role;
    public $level = '';
    public $updateMode = false;
    public $inputs = [];
    public $i = 1;

    public function add($i)
    {
        $i = $i + 1;
        $this->i = $i;
        array_push($this->inputs, $i);
    }
    public function remove($i)
    {
        unset($this->inputs[$i]);
    }
    public function clearFields()
    {
        $this->companyLevel_id = '';
        $this->role = '';
        $this->level = '';
    }
    public function render()
    {
        return view('livewire.workgroup.create', [
            'CompanyLevel' => CompanyLevel::where('level', $this->level)->get(),
        ]);
    }
    public function store()
    {
        $validatedData = $this->validate([
            'companyLevel_id' => 'required',
            'role.0' => 'required',
            'role.*' => 'required',
        ]
        );
        foreach ($this->role as $key => $value) {
            Workgroup::create([
                'companyLevel_id' => $this->companyLevel_id,
                'job_class' => $this->role[$key],
            ]);
        }
        session()->flash('success', 'Data added Successfully!!');
        $this->emit('AddWorkgroup');
        $this->clearFields();
    }
}
