<?php

namespace App\Http\Livewire\Roster;

use App\Models\Roster;
use Livewire\Component;

class Create extends Component
{
    public $name;
    public function render()
    {
        return view('livewire.roster.create');
    }

    public function store()
    {
        $this->validate([
            'name' => 'required',
        ]);

        try {
            Roster::create([
                'name' => $this->name,
            ]);
            session()->flash('success', 'Data Updated Successfully!!');
            $this->emit('addRoster');
            $this->name = '';
        } catch (\Throwable $th) {
            session()->flash('error', 'Something goes wrong!!');
        }
    }
}
