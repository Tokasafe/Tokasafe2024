<?php

namespace App\Http\Livewire\WorkflowStep;

use App\Models\WorkflowStep;
use Livewire\Component;

class Update extends Component
{
    public $name;
    public $description;
    public $status_code;
    public $data_id;
    public $openModal = '';
    protected $listeners = [

        'DataUpdate',
    ];
    public function DataUpdate($value)
    {
        if (!is_null($value)) {
            $this->data_id = $value;
            $step = WorkflowStep::where('id', $this->data_id)->first();
            $this->name = $step->name;
            $this->status_code = $step->status_code;
            $this->description = $step->description;

            $this->openModal = 'modal-open';
        }
    }
    public function render()
    {
        return view('livewire.workflow-step.update');
    }
    public function store()
    {

        $this->validate([
            'name' => 'required',
            'description' => 'required',
            'status_code' => 'required',
        ]);
        try {
            WorkflowStep::whereId($this->data_id)->update([
                'name' => $this->name,
                'description' => $this->description,
                'status_code' => $this->status_code,
            ]);
            session()->flash('success', 'Data Updated Successfully!!');
            $this->clearFilds();
        } catch (\Exception $ex) {
            session()->flash('success', 'Something goes wrong!!');
        }
        $this->emit('UpdateWorkflowStep');
        $this->openModal = '';
    }
    public function clearFilds()
    {
        $this->name = '';
        $this->description = '';
        $this->status_code = '';
    }
    public function outModal()
    {
        $this->openModal = '';
    }
}
