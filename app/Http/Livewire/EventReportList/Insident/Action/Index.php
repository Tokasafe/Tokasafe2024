<?php

namespace App\Http\Livewire\EventReportList\Insident\Action;

use App\Models\People;
use Livewire\Component;
use App\Models\UserSecurity;
use Livewire\WithPagination;
use App\Models\PanelIncident;
use App\Models\IncidentAction;

class Index extends Component
{
    public $data_id, $modalDelete = "modal", $delete_id,$guest_respons=false,$IncidentClose,$assignTo,$also_assignTo,$WorkflowStep_name;
    use WithPagination;
   
    
    public function mount($id)
    {
        $this->data_id = $id;
            $close = PanelIncident::where('incident_report_id', $this->data_id)->first()->WorkflowStep->name;
            if ($close === 'Closed' || $close === 'Cancelled') {
                $this->IncidentClose = $close;
            }
            $this->WorkflowStep_name = PanelIncident::where('incident_report_id', $this->data_id)->first()->WorkflowStep->name;
            $panel = PanelIncident::where('incident_report_id',$this->data_id)->first();
          
            if ($panel->assignTo) {
                $this->assignTo = $panel->assignTo;
            }
            if ($panel->also_assignTo) {
                $this->also_assignTo = $panel->also_assignTo;
            }
        if (!empty(People::whereIn('network_username', [auth()->user()->username])->first()->id)) {
            $id_people = People::whereIn('network_username', [auth()->user()->username])->first()->id;
            $workflow = UserSecurity::with('People')->where('user_id', $id_people)->whereIn('workflow', ['Moderator', 'Event Report Manager'])->pluck('workflow')->toArray();
            $nameStep = 'Assign & Investigation';
            if (in_array('Moderator', $workflow)) {
                $this->guest_respons = true;
            } elseif (in_array('Event Report Manager', $workflow) && $this->WorkflowStep_name === $nameStep && $this->assignTo === $id_people) {
                $this->guest_respons = true;
            } elseif (in_array('Event Report Manager', $workflow) && $this->WorkflowStep_name === $nameStep &&  $this->also_assignTo === $id_people) {
                $this->guest_respons = true;
            } else {
                $this->guest_respons = false;
            }
           
        } 
    }
    protected $listeners = [
     
        'addActionIncident' => 'render',
        'UpdateAction_Incident' => 'render'
    ];
   
    public function render()
    {
        return view('livewire.event-report-list.insident.action.index', [
            'IncidentAction' => IncidentAction::with(['People','IncidentAction'])->where('incident_report_id', $this->data_id)->paginate(10)
        ]);
    }
    public function update($id)
    {
        $this->emit('UpdateActionIncident', $id);
    }

    public function delete($id)
    {
        $this->modalDelete = "modal modal-open";
        $this->delete_id = $id;
    }
    public function deleteFileAction()
    {
        try {
            $this->modalDelete = "modal";
            IncidentAction::find($this->delete_id)->delete();
            session()->flash('success', "Deleted Successfully!!");
        } catch (\Exception $e) {
            session()->flash('error', "Something goes wrong!!");
        }
    }
}
