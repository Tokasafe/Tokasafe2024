<?php

namespace App\Http\Livewire\RealFlowEvent;

use App\Models\WorkflowStep;
use App\Models\WorkflowTempalte;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;
    public $WorkflowTemplate = [];

    public $search = '';
    public $IdData;
    public $name;
    public $hide = true;
    protected $listeners = [

        'AddTemplate' => 'render',
        'UpdateTemplates' => 'render',
    ];
    public function render()
    {

        $this->WorkflowTemplate = WorkflowTempalte::get();
        if (empty($this->search)) {
            $this->hide = false;
        } else {
            $this->hide = true;
            
            $this->emit('update_workflow_template', $this->search);
        }

        return view('livewire.real-flow-event.index', [
            'Template'=>WorkflowTempalte::whereId($this->search)->paginate(2),
            'EventType' => WorkflowStep::with('EventType')->where('workflow_template', $this->search)->paginate(5),
        ])->extends('navigation.homebase', ['header' => 'Event Register'])->section('content');
    }

    public function update_template($id)
    {
        $this->emit('TemplateUpdate', $id);
    }
    public function deleteTemplate($id)
    {
        
        $this->IdData = $id;
        $this->name = WorkflowTempalte::where('id',$id)->first()->name;
    }
    public function deleteFile()
    {
        try {
            WorkflowTempalte::find($this->IdData)->delete();
            session()->flash('success', "Port Deleted Successfully!!");
        } catch (\Exception $e) {
            session()->flash('error', "Something goes wrong!!");
        }
    }
}
