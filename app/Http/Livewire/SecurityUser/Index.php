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
      
        return view('livewire.security-user.index')->with([
            'UserSecurity' => UserSecurity::with([
                'People',
                'event_type',
                'Workgroup.CompanyLevel',
                'Workgroup.CompanyLevel.BussinessUnit',
            ])->searchperson(trim($this->searchPerson))->searchwokrgroup(trim($this->searchPerson))->paginate(25),
        ])->extends('navigation.homebase', ['header' => 'Security User'])->section('content');

        $this->resetPage('userSecurityPage');
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
