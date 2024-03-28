<?php

namespace App\Http\Livewire\Event\Site;

use App\Models\EventSite;
use Livewire\Component;

class Create extends Component
{
    public $name;
    public function render()
    {
        return view('livewire.event.site.create');
    }
    public function store()
    {

        $this->validate([
            'name' => 'required',
        ]);
        EventSite::create([
            'name' => $this->name,
        ]);
        $this->emit('AddSite');
        $this->name = null;
        session()->flash('success', 'Site has been added!!!');
    }
}
