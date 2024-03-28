<?php

namespace App\Http\Livewire\Event\Location;

use App\Models\EventLocation;
use Livewire\Component;

class Index extends Component
{
    public $search = '';
    public $nameData;
    public $IdData;
    protected $listeners = [

        'AddLocationEvent' => 'render',
        'UpdateLocationEvent' => 'render',
    ];
    public function render()
    {
        return view('livewire.event.location.index', [
            'EventLocation' => EventLocation::orderBy('name', 'ASC')->search(trim($this->search))->paginate(5),
        ])->extends('navigation.homebase', ['header' => 'Event Location'])->section('content');
    }
    public function update_EventLocation($id)
    {
        $this->emit('UpdateEventLocation', $id);
    }
    public function delete_EventLocation($id)
    {
        $this->IdData = $id;
        $this->nameData = EventLocation::whereId($id)->first()->name;
    }
    public function deleteFile()
    {
        try {
            EventLocation::find($this->IdData)->delete();
            session()->flash('success', "Event Category Deleted Successfully!!");
        } catch (\Exception $e) {
            session()->flash('error', "Something goes wrong!!");
        }
    }
    public function paginationView()
    {
        return 'livewire.pagination';
    }
}
