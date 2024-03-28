<?php

namespace App\Http\Livewire\Risk\Consequence;

use App\Models\RiskConsequence;
use Livewire\Component;

class Create extends Component
{
    public $name;
    public $description;
    public function render()
    {
        return view('livewire.risk.consequence.create');
    }
    public function store()
    {

        $this->validate([
            'name' => 'required',
            'description' => 'required',
        ]);
        RiskConsequence::create([
            'name' => $this->name,
            'description' => $this->description,
        ]);
        $this->emit('AddConsequence');
        $this->clearfilds();
        session()->flash('success', 'Risk Consequence has been added!!!');
    }
    public function clearfilds()
    {
        $this->name = '';
        $this->description = '';
    }
}
