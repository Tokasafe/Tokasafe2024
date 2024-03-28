<?php

namespace App\Http\Livewire\Event\Location;

use App\Models\EventLocation;
use Livewire\Component;

class Update extends Component
{
    public $data;
    public $name;
    public $data_id;
    public $openModal = '';
    protected $listeners = [

        'UpdateEventLocation',
    ];
    public function UpdateEventLocation($value)
    {
        if (!is_null($value)) {
            $this->data_id = $value;
            $this->name = EventLocation::where('id', $this->data_id)->first()->name;

            $this->openModal = 'modal-open';
        }
    }
    public function render()
    {
        return view('livewire.event.location.update');
    }
    public function store()
    {

        $this->validate([
            'name' => 'required',
        ]);
        try {
            EventLocation::whereId($this->data_id)->update([
                'name' => $this->name,
            ]);
            session()->flash('success', 'Data Updated Successfully!!');
            $this->name = null;
        } catch (\Exception $ex) {
            session()->flash('success', 'Something goes wrong!!');
        }
        $this->emit('UpdateLocationEvent');
        $this->openModal = '';
    }

    public function outModal()
    {
        $this->openModal = '';
    }
}
