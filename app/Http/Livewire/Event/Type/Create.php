<?php

namespace App\Http\Livewire\Event\Type;

use App\Models\EventCategory;
use App\Models\EventType;
use Livewire\Component;

class Create extends Component
{
    public $name;
    public $eventCategory_id;
    public function render()
    {
        return view('livewire.event.type.create', [
            'EventCategory' => EventCategory::get(),
        ]);
    }
    public function store()
    {

        $this->validate([
            'eventCategory_id' => 'required',
            'name' => 'required',
        ]);

        EventType::create([
            'name' => $this->name,
            'eventCategory_id' => $this->eventCategory_id,
        ]);
        session()->flash('success', 'Data added Successfully!!');
        $this->clearFields();
        $this->emit('AddEventType');
    }
    public function clearFields()
    {
        // $this->eventCategory_id = '';
        $this->name = '';
    }
}
