<?php

namespace App\Http\Livewire\Port;

use App\Models\Port;
use Livewire\Component;

class Create extends Component
{
    public $name;
    public $code;
    public function render()
    {
        return view('livewire.port.create');
    }
    public function store()
    {

        $this->validate([
            'code' => 'required',
            'name' => 'required',
        ]);

        Port::create([
            'name' => $this->name,
            'code' => $this->code,
        ]);
        session()->flash('success', 'Data added Successfully!!');
        $this->clearFields();
        $this->emit('AddPort');
    }
    public function clearFields()
    {
        $this->code = '';
        $this->name = '';
    }
}
