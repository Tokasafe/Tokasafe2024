<?php

namespace App\Http\Livewire\RealFlowEvent;

use Livewire\Component;
use App\Models\WorkflowTempalte;

class Update extends Component
{
    public $data_id,$name,$openModal='';
    protected $listeners = [

        'TemplateUpdate',
    ];
    public function TemplateUpdate($value)
    {
        if (!is_null($value)) {
            
            $this->data_id = $value;
            $WorkflowTempalte = WorkflowTempalte::where('id', $this->data_id)->first();
            $this->name=$WorkflowTempalte->name;
            $this->openModal = 'modal-open';
        }
    }
    public function render()
    {
        return view('livewire.real-flow-event.update');
    }

    public function store()
    {

        $this->validate([
            'name' => 'required',
        ]);
        try {
            WorkflowTempalte::whereId($this->data_id)->update([
                'name' => $this->name,
            ]);
            session()->flash('success', 'Data Updated Successfully!!');
           $this->outModal();
        } catch (\Exception $ex) {
            session()->flash('success', 'Something goes wrong!!');
        }
        $this->emit('UpdateTemplates');
     
    }

    public function outModal()
    {
        $this->openModal = '';
    }
}
