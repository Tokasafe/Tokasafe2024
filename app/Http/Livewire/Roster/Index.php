<?php

namespace App\Http\Livewire\Roster;

use App\Models\Roster;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;
    public $name;
    public $searchRoster = '';
    public $IdData;
    protected $listeners = [

        'addRoster' => 'render',
        'updateRoster' => 'render',
    ];
    public function render()
    {
        return view('livewire.roster.index', [
            'Roster' => Roster::search(trim($this->searchRoster))->paginate(5),
        ])->extends('navigation.homebase', ['header' => 'Roster'])->section('content');
    }
    public function update_Roster($id)
    {
        $this->emit('DataUpdate', $id);
    }
    public function deleteRoster($id)
    {
        $this->IdData = $id;
        $this->name = Roster::whereId($id)->first()->name;
    }
    public function deleteFile()
    {
        try {
            Roster::find($this->IdData)->delete();
            session()->flash('success', "Roster Deleted Successfully!!");
        } catch (\Exception $e) {
            session()->flash('error', "Something goes wrong!!");
        }
    }
    public function paginationView()
    {
        return 'livewire.pagination';
    }

}
