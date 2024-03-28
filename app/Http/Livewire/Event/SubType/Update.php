<?php

namespace App\Http\Livewire\Event\SubType;

use App\Models\EventSubType;
use App\Models\EventType;
use Livewire\Component;

class Update extends Component
{
    public $data;
    public $eventType_id;
    public $name;
    public $data_id;
    public $openModal = '';
    protected $listeners = [

        'EventSubTypeUpdate',
    ];
    public function EventSubTypeUpdate($value)
    {
        if (!is_null($value)) {
            $this->data_id = $value;
            $subtype = EventSubType::where('id', $this->data_id)->first();
            $this->name = $subtype->name;
            $this->eventType_id = $subtype->eventType_id;
            $this->openModal = 'modal-open';
        }
    }
    public function render()
    {
        return view('livewire.event.sub-type.update', [
            'EventType' => EventType::get(),
        ]);
    }
    public function store()
    {

        $this->validate([
            'name' => 'required',
            'eventType_id' => 'required',
        ]);
        try {
            EventSubType::whereId($this->data_id)->update([
                'name' => $this->name,
                'eventType_id' => $this->eventType_id,
            ]);
            session()->flash('success', 'Data Updated Successfully!!');
            $this->emit('UpdateEventSubType');
            $this->clearFilds();
        } catch (\Exception $ex) {
            session()->flash('error', 'Something goes wrong!!');
        }
    }
    public function clearFilds()
    {
        $this->name = '';
        $this->eventType_id = '';
        $this->openModal = '';
    }
    public function outModal()
    {
        $this->openModal = '';
    }
}
