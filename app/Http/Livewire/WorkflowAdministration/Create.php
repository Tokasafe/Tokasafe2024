<?php

namespace App\Http\Livewire\WorkflowAdministration;

use App\Models\ResponsibleRole;
use App\Models\StatusCode;
use App\Models\WorkflowAdministration;
use Livewire\Component;

class Create extends Component
{
    public $name,$checkCancel=false;
    public $description;
    public $destination_1 = '';
    public $destination_2 = '';
    public $destination_1_label = '';
    public $destination_2_label = '';
    public $status_code;
    public $responsible_role;
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
        return view('livewire.workflow-administration.create', [
            'Responsible_role' => ResponsibleRole::get(),
            'StatusCode' => StatusCode::get(),
            'WorkflowAdministration' => WorkflowAdministration::where('workflow_template', $this->workflow_template)->get(),
        ]);
    }
    public function store()
    {
       
        $this->validate([
            'name' => 'required',
            'description' => 'required',
            'status_code' => 'required',
            'responsible_role' => 'required',
        ]
        );
        try {
            WorkflowAdministration::create([
                'name' => $this->name,
                'description' => $this->description,
                'status_code' => $this->status_code,
                'responsible_role' => $this->responsible_role,
                'destination_1' => $this->destination_1,
                'destination_2' => $this->destination_2,
                'destination_1_label' => $this->destination_1_label,
                'destination_2_label' => $this->destination_2_label,
                'workflow_template' => $this->workflow_template,
                'checkCancel' => $this->checkCancel,
            ]);
            $this->emit('Add_Wf_Admin');
            $this->resetInputFields();
            session()->flash('message', 'Contact Has Been Created Successfully.');
        } catch (\Throwable $th) {
            //throw $th;
        }

    }

    private function resetInputFields()
    {
        $this->description = '';
        $this->status_code = '';
        $this->name = '';
        $this->responsible_role = '';
        $this->destination_1 = '';
        $this->destination_2 = '';
        $this->destination_1_label = '';
        $this->destination_2_label = '';
    }

}
