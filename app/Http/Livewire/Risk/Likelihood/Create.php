<?php

namespace App\Http\Livewire\Risk\Likelihood;

use App\Models\RiskLikelihood;
use Livewire\Component;

class Create extends Component
{
    public $name;
    public $notes;
    public function render()
    {
        return view('livewire.risk.likelihood.create');
    }
    public function store()
    {

        $this->validate([
            'name' => 'required',
            'notes' => 'required',
        ]);
        RiskLikelihood::create([
            'name' => $this->name,
            'notes' => $this->notes,
        ]);
        $this->emit('AddLikelihood');
        $this->clearfilds();
        session()->flash('success', 'Risk Likelihood has been added!!!');
    }
    public function clearfilds()
    {
        $this->name = '';
        $this->notes = '';
    }
}
