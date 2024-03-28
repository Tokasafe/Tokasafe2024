<?php

namespace App\Http\Livewire\Role;

use App\Models\Role;
use App\Models\RoleClass;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;
    public $searchRoleClass = '';
    public $searchRole = '';
    public $role_Class;
    public $Role_name;
    public $IdData;
    protected $listeners = [

        'AddRole' => 'render',
        'UpdateRole' => 'render',
    ];
    public function render()
    {
        return view('livewire.role.index', [
            'Role' => Role::with(['RoleClass'])->role(trim($this->searchRole))->roleclass(trim($this->searchRoleClass))->paginate(5),
            'RoleClass' => RoleClass::get(),
        ])->extends('navigation.homebase', ['header' => 'Roles'])->section('content');
    }
    public function update_Role($id)
    {
        $this->emit('DataUpdate', $id);
    }
    public function deleteRole($id)
    {
        $this->IdData = $id;
        $this->role_Class = Role::whereId($id)->first()->RoleClass->name;
        $this->Role_name = Role::whereId($id)->first()->name;
    }
    public function deleteFile()
    {
        try {
            Role::find($this->IdData)->delete();
            session()->flash('success', "Role Deleted Successfully!!");
        } catch (\Exception $e) {
            session()->flash('error', "Something goes wrong!!");
        }
    }
    public function paginationView()
    {
        return 'livewire.pagination';
    }
}
