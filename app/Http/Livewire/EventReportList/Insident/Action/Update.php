<?php

namespace App\Http\Livewire\EventReportList\Insident\Action;

use App\Models\People;
use Livewire\Component;
use Livewire\WithPagination;
use App\Models\IncidentAction;

class Update extends Component
{
    use WithPagination;
    public $description_incident, $followup_action, $actionee_comments, $incident_report_id, $action_condition, $orginal_dueDate, $responsibility, $dueDate, $completion_date, $personal_reminder;

    public $data_id, $IncidentClose, $openModalUpdate = "modal", $open_Responsibility = "modal", $search_reportBy = '', $report_to;
    protected $listeners = [

        'UpdateActionIncident',
    ];
    public function UpdateActionIncident($value)
    {
        if (!is_null($value)) {
            $this->data_id = $value;
            $ActionIncident = IncidentAction::find($this->data_id);
            $this->description_incident = $ActionIncident->description_incident;
            $this->followup_action = $ActionIncident->followup_action;
            $this->actionee_comments = $ActionIncident->actionee_comments;
            $this->action_condition = $ActionIncident->action_condition;
            $this->incident_report_id = $ActionIncident->incident_report_id;
            $this->description_incident = $ActionIncident->description_incident;
            if ($ActionIncident->responsibility) {
                $this->report_to = $ActionIncident->People->lookup_name;
                $this->responsibility = $ActionIncident->responsibility;
            } else {
                $this->report_to = "";
                $this->responsibility = "";
            }
            $this->orginal_dueDate = ($ActionIncident->orginal_dueDate) ?date('d-m-Y', strtotime($ActionIncident->orginal_dueDate)) : '' ;
            $this->dueDate =($ActionIncident->dueDate)? date('d-m-Y', strtotime($ActionIncident->dueDate)):'';
            $this->completion_date =($ActionIncident->completion_date)? date('d-m-Y', strtotime($ActionIncident->completion_date)):'';
            $this->personal_reminder =($ActionIncident->personal_reminder)? date('d-m-Y', strtotime($ActionIncident->personal_reminder)):'';

            $this->openModalUpdate = "modal modal-open";
        }
    }
    public function render()
    {
        return view('livewire.event-report-list.insident.action.update', [
            'Responsibility' => People::with('Employer')->search(trim($this->search_reportBy))->paginate(100, ['*'], 'ResponsibilityPage'),
        ]);
    }
    public function openResponsibility()
    {
        $this->open_Responsibility  = "modal modal-open";
    }
    public function closeResponsibility()
    {
        $this->open_Responsibility  = "modal";
    }
    public function cariResponsibility($id)
    {
        if ($id) {
            $this->responsibility = $id;
            $this->report_to = People::whereId($id)->first()->lookup_name;
            $this->closeResponsibility();
        } else {
            $this->responsibility = '';
            $this->report_to = '';
        }
    }
    public function updateStore()
    {
        if ($this->orginal_dueDate) {
            $orginal_dueDate = date('Y-m-d', strtotime($this->orginal_dueDate));
        } else{
            $orginal_dueDate = null;
        }
        if ($this->dueDate) {
          $dueDate = date('Y-m-d', strtotime($this->dueDate));
        } else {
          $dueDate = null;
        }
        if ($this->completion_date) {
            $completion_date = date('Y-m-d', strtotime($this->completion_date));
        } else {
            $completion_date = null;
        }
        if ($this->personal_reminder) {

           $personal_reminder = date('Y-m-d', strtotime($this->personal_reminder));
        } else {
           $personal_reminder = null;
        }
        try {
            $this->validate([
                'description_incident' => 'nullable',
                'followup_action' => 'required',
                'actionee_comments' => 'nullable',
                'action_condition' => 'nullable',
                'responsibility' => 'nullable',
                'orginal_dueDate' => 'nullable',
                'dueDate' => 'nullable',
                'completion_date' => 'nullable',
                'personal_reminder' => 'nullable',
                'incident_report_id' => 'nullable',
            ]);
         
           
            IncidentAction::whereId($this->data_id)->update([
                'description_incident' => $this->description_incident,
                'followup_action' => $this->followup_action,
                'actionee_comments' => $this->actionee_comments,
                'action_condition' => $this->action_condition,
                'responsibility' => $this->responsibility,
                'orginal_dueDate' =>$orginal_dueDate,
                'dueDate' =>$dueDate,
                'completion_date' =>$completion_date,
                'personal_reminder' => $personal_reminder,
                'incident_report_id' => $this->incident_report_id
            ]);
            session()->flash('success', 'Data added Successfully!!');
            $this->emit('UpdateAction_Incident');
            $this->closeModalUpdate();
        } catch (\Throwable $th) {
            session()->flash('error', "Something goes wrong!!");
        }
    }
    public function closeModalUpdate()
    {
        $this->openModalUpdate = "modal";
    }
}
