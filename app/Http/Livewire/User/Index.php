<?php

namespace App\Http\Livewire\User;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;
    public $IdData,$nameData;
    protected $listeners = [

        'AddUser' => 'render',
        'updateUser' => 'render',
    ];
    public function render()
    {
        return view('livewire.user.index',[
            "User" => User::with('Roles')->paginate(10)
        ])->extends('navigation.homebase', ['header' => 'User'])->section('content');
    }
    public function update($id)
    {
        $this->emit('UpdateUsers', $id);
    }
    public function delete($id)
    {
        $this->IdData = $id;
        $this->nameData = User::whereId($id)->first()->name;
    }
    public function deleteFile()
    {
        try {
            User::find($this->IdData)->delete();
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
