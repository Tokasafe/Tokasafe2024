<?php

namespace App\Http\Livewire\Event\SubType;

use App\Models\EventSubType;
use App\Models\EventType;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;
    public $searchEventType = '';
    public $searchEventSubType = '';
    public $event_type;
    public $eventSubtype_name;
    public $IdData;
    protected $listeners = [

        'AddEventSubType' => 'render',
        'UpdateEventSubType' => 'render',
    ];
    public function render()
    {
        return view('livewire.event.sub-type.index', [
            'SubType' => EventSubType::with(['EventType'])->searchtype(trim($this->searchEventType))->searcsubtype(trim($this->searchEventSubType))->paginate(5),
            'EventType' => EventType::get(),
        ])->extends('navigation.homebase', ['header' => 'Event Sub Type'])->section('content');
    }
    public function update_EventSubType($id)
    {
        $this->emit('EventSubTypeUpdate', $id);
    }
    public function deleteEventSubType($id)
    {
        $this->IdData = $id;
        $this->event_type = EventSubType::whereId($id)->first()->EventType->name;
        $this->eventSubtype_name = EventSubType::whereId($id)->first()->name;
    }
    public function deleteFile()
    {
        try {
            EventSubType::find($this->IdData)->delete();
            session()->flash('success', "Event Sub Type Deleted Successfully!!");
        } catch (\Exception $e) {
            session()->flash('error', "Something goes wrong!!");
        }
    }
    public function paginationView()
    {
        return 'livewire.pagination';
    }
}
