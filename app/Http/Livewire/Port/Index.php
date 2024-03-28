<?php

namespace App\Http\Livewire\Port;

use App\Models\Port;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;
    public $searchPort = '';
    public $code;
    public $name;
    public $IdData;
    protected $listeners = [

        'AddPort' => 'render',
        'UpdatePort' => 'render',
    ];
    public function render()
    {
        return view('livewire.port.index', [
            'Port' => Port::paginate(5),
        ])->extends('navigation.homebase', ['header' => 'Port'])->section('content');
    }
    public function update_Port($id)
    {
        $this->emit('DataUpdate', $id);
    }
    public function deletePort($id)
    {
        $this->IdData = $id;
        $this->code = Port::whereId($id)->first()->code;
        $this->name = Port::whereId($id)->first()->name;
    }
    public function deleteFile()
    {
        try {
            Port::find($this->IdData)->delete();
            session()->flash('success', "Port Deleted Successfully!!");
        } catch (\Exception $e) {
            session()->flash('error', "Something goes wrong!!");
        }
    }
    public function paginationView()
    {
        return 'livewire.pagination';
    }

}
