<?php

namespace App\Http\Livewire\AccessRiskAssessment;

use App\Models\AccessRiskAssessment;
use App\Models\EventType;
use Livewire\Component;

class Create extends Component
{
    public $event_type_id;
    public function render()
    {
        return view('livewire.access-risk-assessment.create', [
            'EventType' => EventType::get(),
        ]);
    }
    public function storeCompany()
    {

        $this->validate([
            'event_type_id' => 'required',
        ]);

        AccessRiskAssessment::create([
            'event_type_id' => $this->event_type_id,
        ]);
        session()->flash('success', 'Data added Successfully!!');
        $this->clearFields();
        $this->emit('AddRisk');
    }
    public function clearFields()
    {
        $this->event_type_id = '';
    }
}
