<?php

namespace App\Http\Livewire\RoleUser;

use App\Models\Roles;
use Livewire\Component;

class Index extends Component
{
    public $IdData,$nameData;
    protected $listeners = [

        'AddRoleUsers' => 'render',
        'UpdateRoleUsers' => 'render',
    ];
    public function render()
    {
        return view('livewire.role-user.index',[
            'RoleUser'=>Roles::paginate(10)
        ])->extends('navigation.homebase', ['header' => 'Role User'])->section('content');
    }
    public function update($id)
    {
        $this->emit('UpdateRolesUser', $id);
    }
    public function delete($id)
    {
        $this->IdData = $id;
        $this->nameData = Roles::whereId($id)->first()->name;
    }
    public function deleteFile()
    {
        try {
            Roles::find($this->IdData)->delete();
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
