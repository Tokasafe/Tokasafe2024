<?php

namespace App\Http\Livewire\Event\Type;

use App\Models\EventCategory;
use App\Models\EventType;
use Livewire\Component;

class Update extends Component
{
    public $data;
    public $eventCategory_id;
    public $name;
    public $data_id;
    public $openModal = '';
    protected $listeners = [

        'EventTypeUpdate',
    ];
    public function EventTypeUpdate($value)
    {
        if (!is_null($value)) {
            $this->data_id = $value;
            $type = EventType::where('id', $this->data_id)->first();
            $this->name = $type->name;
            $this->eventCategory_id = $type->eventCategory_id;
            $this->openModal = 'modal-open';
        }
    }
    public function render()
    {
        return view('livewire.event.type.update', [
            'EventCategory' => EventCategory::get(),
        ]);
    }
    public function store()
    {

        $this->validate([
            'name' => 'required',
            'eventCategory_id' => 'required',
        ]);
        try {
            EventType::whereId($this->data_id)->update([
                'name' => $this->name,
                'eventCategory_id' => $this->eventCategory_id,
            ]);
            session()->flash('success', 'Data Updated Successfully!!');
            $this->emit('UpdateEventType');
            $this->clearFilds();
        } catch (\Exception $ex) {
            session()->flash('success', 'Something goes wrong!!');
        }
    }
    public function clearFilds()
    {
        $this->name = '';
        $this->eventCategory_id = '';
        $this->openModal = '';
    }
    public function outModal()
    {
        $this->openModal = '';
    }
}
