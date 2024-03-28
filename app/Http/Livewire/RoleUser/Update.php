<?php

namespace App\Http\Livewire\RoleUser;

use App\Models\Roles;
use Livewire\Component;

class Update extends Component
{
    public $name,$openModal='',$data_id;
    protected $listeners = [

        'UpdateRolesUser',
    ];
    public function UpdateRolesUser($value)
    {
        if (!is_null($value)) {
            $this->data_id = $value;
            $role = Roles::where('id', $this->data_id)->first();
            $this->name = $role->name;

            $this->openModal = 'modal-open';
        }
    }
    public function render()
    {
        return view('livewire.role-user.update');
    }
    public function store(){
        $this->validate([
            'name'=>'required'
        ]);
        Roles::whereId($this->data_id)->update([
            'name' => $this->name,
        ]);
        $this->outModal();
        session()->flash('success', 'Data added Successfully!!');
        $this->emit('UpdateRoleUsers');
    }
    public function outModal()
    {
        $this->openModal = '';
    }
}
