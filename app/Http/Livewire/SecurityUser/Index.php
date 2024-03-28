<?php

namespace App\Http\Livewire\SecurityUser;

use App\Models\UserSecurity;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{

    use WithPagination;
    public $nameData;
    public $IdData;
    public $searchPerson = '';
    public $searchWorkgroup = '';
    protected $listeners = [

        'AddUserSecurity' => 'render',
        'UpdateUserSecurity' => 'render',
    ];
    public function render()
    {
        return view('livewire.security-user.index', [
            'UserSecurity' => UserSecurity::with([
                'People',
                'eventsubtype',
                'Workgroup.CompanyLevel',
                'Workgroup.CompanyLevel.BussinessUnit',
            ])->searchperson(trim($this->searchPerson))->searchwokrgroup(trim($this->searchWorkgroup))->paginate(5),
        ])->extends('navigation.homebase', ['header' => 'Security User'])->section('content');
    }
    public function update_UserSecurity($id)
    {
        $this->emit('DataUpdate', $id);
    }
    public function deleteUserSecurity($id)
    {
        $this->IdData = $id;
        $this->nameData = UserSecurity::whereId($id)->first()->People->lookup_name;
    }
    public function deleteFile()
    {
        try {
            UserSecurity::find($this->IdData)->delete();
            session()->flash('success', "User Deleted Successfully!!");
        } catch (\Exception $e) {
            session()->flash('error', "Something goes wrong!!");
        }
    }
    public function paginationView()
    {
        return 'livewire.pagination';
    }

   
}
