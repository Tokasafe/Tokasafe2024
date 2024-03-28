<?php

namespace App\Http\Livewire\StatusCode;

use App\Models\StatusCode;
use Livewire\Component;

class Create extends Component
{
    public $name;
    public function render()
    {
        return view('livewire.status-code.create');
    }

    public function store()
    {
        $this->validate([
            'name' => 'required',
        ]);
        try {
            StatusCode::create([
                'name' => $this->name,
            ]);
            session()->flash('success', 'Data added Successfully!!');
            $this->emit('addStatusCode');
            $this->name = '';
        } catch (\Throwable $th) {
            session()->flash('error', 'Something wrong!!');
        }
    }
}
