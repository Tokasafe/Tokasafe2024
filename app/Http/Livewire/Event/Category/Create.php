<?php

namespace App\Http\Livewire\Event\Category;

use App\Models\EventCategory;
use Livewire\Component;

class Create extends Component
{
    public $name;
    public function render()
    {
        return view('livewire.event.category.create');
    }
    public function store()
    {

        $this->validate([
            'name' => 'required',
        ]);
        EventCategory::create([
            'name' => $this->name,
        ]);
        $this->emit('AddEventCategory');
        $this->name = null;
        session()->flash('success', 'Company Category has been added!!!');
    }
}
