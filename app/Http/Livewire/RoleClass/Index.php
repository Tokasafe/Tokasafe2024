<?php

namespace App\Http\Livewire\RoleClass;

use App\Models\RoleClass;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;
    public $search = '';
    public $nameData;
    public $IdData;
    protected $listeners = [

        'AddRoleClass' => 'render',
        'UpdateRoleClass' => 'render',
    ];
    public function render()
    {
        return view('livewire.role-class.index', [
            'RoleClass' => RoleClass::search(trim($this->search))->paginate(5),
        ])->extends('navigation.homebase', ['header' => 'Roles'])->section('content');
    }
    public function update_RoleClass($id)
    {
        $this->emit('DataUpdate', $id);
    }
    public function deleteRoleClass($id)
    {
        $this->IdData = $id;
        $this->nameData = RoleClass::whereId($id)->first()->name;
    }
    public function deleteFile()
    {
        try {
            RoleClass::find($this->IdData)->delete();
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
