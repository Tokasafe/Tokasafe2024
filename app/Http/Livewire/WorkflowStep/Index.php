<?php

namespace App\Http\Livewire\WorkflowStep;

use App\Models\WorkflowStep;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;
    public $search = '';
    public $nameData;
    public $IdData;
    protected $listeners = [
        'update_workflow_template',
        'AddWorkflowStep' => 'render',
        'UpdateWorkflowStep' => 'render',
    ];
    public function update_workflow_template($value)
    {
        if (!is_null($value)) {
            $this->search = $value;
        }
    }
    public function render()
    {
        return view('livewire.workflow-step.index', [
            "WorkflowTempalte" => WorkflowStep::with('EventType')->where('workflow_template', $this->search)->paginate(5),
        ])->extends('navigation.homebase', ['header' => 'Workflow Step'])->section('content');
    }
    public function update_WorkflowStep($id)
    {
        $this->emit('DataUpdate', $id);
    }
    public function deleteWorkflowStep($id)
    {
        $this->IdData = $id;
        $this->nameData = WorkflowStep::whereId($id)->first()->name;
    }
    public function deleteFile()
    {
        try {
            WorkflowStep::find($this->IdData)->delete();
            session()->flash('success', "Workflow Step Deleted Successfully!!");
        } catch (\Exception $e) {
            session()->flash('error', "Something goes wrong!!");
        }
    }
    public function paginationView()
    {
        return 'livewire.pagination';
    }
}
