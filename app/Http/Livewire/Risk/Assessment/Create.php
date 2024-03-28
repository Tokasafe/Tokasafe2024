<?php

namespace App\Http\Livewire\Risk\Assessment;

use App\Models\RiskAssessment;
use Livewire\Component;

class Create extends Component
{
    public $name;
    public $notes;
    public $investigation_req;
    public $reporting_obligation;
    public function render()
    {
        return view('livewire.risk.assessment.create');
    }
    public function store()
    {

        $this->validate([
            'name' => 'required',
            'notes' => 'required',
            'investigation_req' => 'required',
            'reporting_obligation' => 'required',
        ]);
        RiskAssessment::create([
            'name' => $this->name,
            'notes' => $this->notes,
            'investigation_req' => $this->investigation_req,
            'reporting_obligation' => $this->reporting_obligation,
        ]);
        $this->emit('AddAssessment');
        $this->clearfilds();
        session()->flash('success', 'Risk Consequence has been added!!!');
    }
    public function clearfilds()
    {
        $this->name = '';
        $this->notes = '';
        $this->investigation_req = '';
        $this->reporting_obligation = '';
    }
}
