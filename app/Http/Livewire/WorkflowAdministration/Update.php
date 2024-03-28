<?php

namespace App\Http\Livewire\WorkflowAdministration;

use App\Models\ResponsibleRole;
use App\Models\StatusCode;
use App\Models\WorkflowAdministration;
use Livewire\Component;

class Update extends Component
{
    public $data_id;
    public $openModal = '';
    public $name,$checkCancel=false;
    public $description;
    public $destination_1 = '';
    public $destination_2 = '';
    public $destination_1_label = '';
    public $destination_2_label = '';
    public $status_code;
    public $responsible_role;
    public $workflow_template;
    protected $listeners = [
        'update_workflow_template',
        'Wf_id',
    ];

    public function update_workflow_template($value)
    {
        if (!is_null($value)) {
            $this->workflow_template = $value;

        }
    }
    public function Wf_id($value)
    {
        if (!is_null($value)) {
            $this->data_id = $value;
            $s_code = WorkflowAdministration::whereId($this->data_id)->first();
            $this->name = $s_code->name;
            $this->description = $s_code->description;
            $this->destination_1 = $s_code->destination_1;
            $this->destination_2 = $s_code->destination_2;
            $this->destination_1_label = $s_code->destination_1_label;
            $this->destination_2_label = $s_code->destination_2_label;
            $this->status_code = $s_code->status_code;
            $this->responsible_role = $s_code->responsible_role;
            $this->checkCancel = $s_code->checkCancel;
            $this->openModal = 'modal-open';
        }
    }
    public function render()
    {
        return view('livewire.workflow-administration.update', [
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
            WorkflowAdministration::whereId($this->data_id)->update([
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
            $this->emit('UpdateWfAdmin');
            session()->flash('success', 'Data Updated Successfully!!');
        } catch (\Throwable $th) {
            session()->flash('success', 'Something goes wrong!!');
        }

    }
    public function closeModal()
    {
        $this->openModal = '';
    }

}
