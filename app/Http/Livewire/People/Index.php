<?php

namespace App\Http\Livewire\People;

use App\Models\People;
use Livewire\Component;
use Livewire\WithPagination;
use App\Imports\PeopleImport;
use Maatwebsite\Excel\Facades\Excel;

class Index extends Component
{
    use WithPagination;
    public $IdData;
    public $fileImport;
    public $name;
    public $search;
    protected $listeners = [

        'Add_People' => 'render',
        'updatedPeople' => 'render',
    ];
    public function render()
    {
        return view('livewire.people.index', [
            'People' => People::with('Employer')->search($this->search)->orderBy('lookup_name')->paginate(20),
        ])->extends('navigation.homebase', ['header' => 'People'])->section('content');
    }
    public function update_org($id)
    {

        $this->emit('UpdatePeople', $id);
    }
    public function deletePeople($id)
    {
        $this->IdData = $id;
        $this->name = People::whereId($id)->first()->lookup_name;
    }

   
    public function deleteFile()
    {
        try {
            People::find($this->IdData)->delete();
            session()->flash('success', "People Deleted Successfully!!");
        } catch (\Exception $e) {
            session()->flash('error', "Something goes wrong!!");
        }
    }
    public function paginationView()
    {
        return 'livewire.pagination';
    }
}
