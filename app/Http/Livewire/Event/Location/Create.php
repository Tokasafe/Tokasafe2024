<?php

namespace App\Http\Livewire\Event\Location;

use App\Models\EventLocation;
use Livewire\Component;

class Create extends Component
{
    public $name;
    public function render()
    {
        return view('livewire.event.location.create');
    }
    public function store()
    {

        $this->validate([
            'name' => 'required',
        ]);
        EventLocation::create([
            'name' => $this->name,
        ]);
        $this->emit('AddLocationEvent');
        $this->name = null;
        session()->flash('success', 'Company Category has been added!!!');
    }
}
