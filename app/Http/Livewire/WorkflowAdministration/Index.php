<?php

namespace App\Http\Livewire\WorkflowAdministration;

use App\Models\EventType;
use App\Models\WorkflowAdministration;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    public $nameData;
    public $search = '';
    public $workflow_template_id;
    use WithPagination;
    protected $listeners = [
        'update_workflow_template',
        'Add_Wf_Admin' => 'render',
        'UpdateWfAdmin' => 'render',
    ];
    public function update_workflow_template($value)
    {
        if (!is_null($value)) {
            $this->search = $value;
        }
    }
    public function render()
    {
        return view('livewire.workflow-administration.index', [
            'EventType' => EventType::paginate(6),
            'WorkflowAdministration' => WorkflowAdministration::with(['ResponsibleRole', 'StatusCode'])->where('workflow_template', $this->search)->paginate(5),
        ])->extends('navigation.homebase', ['header' => 'Workflow Administration'])->section('content');
    }
    public function update($id)
    {
        $this->emit('Wf_id', $id);
    }
}
