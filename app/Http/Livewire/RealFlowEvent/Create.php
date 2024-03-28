<?php

namespace App\Http\Livewire\RealFlowEvent;

use App\Models\WorkflowStep;
use App\Models\WorkflowTempalte;
use Livewire\Component;

class Create extends Component
{
    public $name;
    public function render()
    {
        return view('livewire.real-flow-event.create');
    }
    public function store(){
        $this->validate([
            'name' => 'required',
        ]);

        WorkflowTempalte::create([
            'name' => $this->name,
        ]);
        session()->flash('success', 'Data added Successfully!!');
        $this->name="";
        $this->emit('AddTemplate');
    }
}
