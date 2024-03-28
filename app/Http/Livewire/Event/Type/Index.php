<?php

namespace App\Http\Livewire\Event\Type;

use App\Models\EventCategory;
use App\Models\EventType;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;
    public $searchEventCategory = '';
    public $searchEventType = '';
    public $event_category;
    public $eventType_name;
    public $IdData;
    protected $listeners = [

        'AddEventType' => 'render',
        'UpdateEventType' => 'render',
    ];
    public function render()
    {
        return view('livewire.event.type.index', [
            'EventType' => EventType::with(['EventCategory'])->searchcategory(trim($this->searchEventCategory))->searchtype(trim($this->searchEventType))->paginate(5),
            'EventCategory' => EventCategory::get(),
        ])->extends('navigation.homebase', ['header' => 'Event Type'])->section('content');
    }
    public function update_EventType($id)
    {
        $this->emit('EventTypeUpdate', $id);
    }
    public function deleteEventType($id)
    {
        $this->IdData = $id;
        $this->event_category = EventType::whereId($id)->first()->EventCategory->name;
        $this->eventType_name = EventType::whereId($id)->first()->name;
    }
    public function deleteFile()
    {
        try {
            EventType::find($this->IdData)->delete();
            session()->flash('success', "Event Type Deleted Successfully!!");
        } catch (\Exception $e) {
            session()->flash('error', "Something goes wrong!!");
        }
    }
    public function paginationView()
    {
        return 'livewire.pagination';
    }
}
