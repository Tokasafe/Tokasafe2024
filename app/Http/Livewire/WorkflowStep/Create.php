<?php

namespace App\Http\Livewire\WorkflowStep;

use App\Models\EventType;
use App\Models\WorkflowStep;
use Livewire\Component;

class Create extends Component
{
    public $name;
    public $event_type;
    public $workflow_template = '';
    protected $listeners = [
        'update_workflow_template',
    ];
    public function update_workflow_template($value)
    {
        if (!is_null($value)) {
            $this->workflow_template = $value;

        }
    }
    public function render()
    {
        return view('livewire.workflow-step.create', [
            'EventType' => EventType::get(),
        ]);
    }
    public function store()
    {

        $this->validate([
            'event_type' => 'required',
        ]);

        WorkflowStep::create([
            'name' => $this->name,
            'eventTypeId' => $this->event_type,
            'workflow_template' => $this->workflow_template,
        ]);
        session()->flash('success', 'Data added Successfully!!');
        $this->clearFields();
        $this->emit('AddWorkflowStep');
    }
    public function clearFields()
    {
        $this->event_type = '';

    }
}
