<?php

namespace App\Http\Livewire\ParentCompany;

use App\Models\CompanyCategory;
use Livewire\Component;

class Update extends Component
{

    public $name;
    public $data_id;
    public $openModal = '';
    protected $listeners = [

        'DataUpdate',
    ];
    public function DataUpdate($value)
    {
        if (!is_null($value)) {
            $this->data_id = $value;
            $this->name = CompanyCategory::where('id', $this->data_id)->first()->name;

            $this->openModal = 'modal-open';
        }

    }
    public function render()
    {
        return view('livewire.parent-company.update');
    }
    public function store()
    {

        $this->validate([
            'name' => 'required',
        ]);
        try {
            CompanyCategory::whereId($this->data_id)->update([
                'name' => $this->name,
            ]);
            session()->flash('success', 'Data Updated Successfully!!');
            $this->name = null;
        } catch (\Exception $ex) {
            session()->flash('success', 'Something goes wrong!!');
        }
        $this->emit('UpdatePC');
        $this->openModal = '';
    }
    public function outModal()
    {
        $this->openModal = '';
    }
}
