<?php

namespace App\Http\Livewire\Event\SubType;

use App\Models\EventSubType;
use App\Models\EventType;
use Livewire\Component;

class Create extends Component
{
    public $name;
    public $eventType_id;
    public function render()
    {
        return view('livewire.event.sub-type.create', [
            'EventType' => EventType::get(),
        ]);
    }
    public function store()
    {

        $this->validate([
            'eventType_id' => 'required',
            'name' => 'required',
        ]);

        EventSubType::create([
            'name' => $this->name,
            'eventType_id' => $this->eventType_id,
        ]);
        session()->flash('success', 'Data added Successfully!!');
        $this->clearFields();
        $this->emit('AddEventSubType');
    }
    public function clearFields()
    {
        $this->eventType_id = '';
        $this->name = '';
    }
}
