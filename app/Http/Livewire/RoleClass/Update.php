<?php

namespace App\Http\Livewire\RoleClass;

use App\Models\RoleClass;
use Livewire\Component;

class Update extends Component
{

    public $name;
    public $description;
    public $data_id;
    public $openModal = '';
    protected $listeners = [

        'DataUpdate',
    ];
    public function DataUpdate($value)
    {
        if (!is_null($value)) {
            $this->data_id = $value;
            $role = RoleClass::where('id', $this->data_id)->first();
            $this->name = $role->name;
            $this->description = $role->description;

            $this->openModal = 'modal-open';
        }
    }
    public function render()
    {
        return view('livewire.role-class.update');
    }
    public function store()
    {

        $this->validate([
            'name' => 'required',
        ]);
        try {
            RoleClass::whereId($this->data_id)->update([
                'name' => $this->name,
                'description' => $this->description,
            ]);
            session()->flash('success', 'Data Updated Successfully!!');
            $this->name = null;
        } catch (\Exception $ex) {
            session()->flash('success', 'Something goes wrong!!');
        }
        $this->emit('UpdateRoleClass');
        $this->openModal = '';
    }
    public function clearFilds()
    {
        $this->name = '';
        $this->description = '';
    }
    public function outModal()
    {
        $this->openModal = '';
    }
}
