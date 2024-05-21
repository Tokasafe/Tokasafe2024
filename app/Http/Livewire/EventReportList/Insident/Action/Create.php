<?php

namespace App\Http\Livewire\EventReportList\Insident\Action;

use App\Models\People;
use Livewire\Component;
use App\Models\PanelIncident;
use App\Models\IncidentAction;
use App\Models\IncidentReport;
use Livewire\WithPagination;

class Create extends Component
{
    use WithPagination;
    public $description_incident, $followup_action, $actionee_comments, $incident_report_id, $action_condition, $orginal_dueDate, $responsibility, $dueDate, $completion_date, $personal_reminder;

    public $data_id, $IncidentClose, $open_Responsibility = "modal", $search_reportBy = '', $report_to;
    public function mount($id)
    {

        $this->data_id = $id;
        $this->incident_report_id = $id;
        $close = PanelIncident::where('incident_report_id', $this->data_id)->first()->WorkflowStep->name;
        if ($close === 'Closed' || $close === 'Cancelled') {
            $this->IncidentClose = $close;
        }
        $incident = IncidentReport::whereId($id)->first();
        $this->description_incident = $incident->task;
    }

    public function render()
    {
        return view('livewire.event-report-list.insident.action.create', [
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
    public function storeAction()
    {
        if ($this->orginal_dueDate) {
            $this->orginal_dueDate = date('Y-m-d', strtotime($this->orginal_dueDate));
        } else{
            $this->orginal_dueDate = null;
        }
        if ($this->dueDate) {
          $this->dueDate = date('Y-m-d', strtotime($this->dueDate));
        } else {
          $this->dueDate = null;
        }
        if ($this->completion_date) {
            $this->completion_date = date('Y-m-d', strtotime($this->completion_date));
        } else {
            $this->completion_date = null;
        }
        if ($this->personal_reminder) {

           $this->completion_date = date('Y-m-d', strtotime($this->personal_reminder));
        } else {
           $this->completion_date = null;
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
            
            
           
            IncidentAction::create([
                'description_incident' => $this->description_incident,
                'followup_action' => $this->followup_action,
                'actionee_comments' => $this->actionee_comments,
                'action_condition' => $this->action_condition,
                'responsibility' => $this->responsibility,
                'orginal_dueDate' =>$this->orginal_dueDate,
                'dueDate' =>$this->dueDate,
                'completion_date' =>$this->completion_date,
                'personal_reminder' => $this->personal_reminder,
                'incident_report_id' => $this->data_id,
            ]);
            session()->flash('success', 'Data added Successfully!!');
            $this->emptyfield();
            $this->closeResponsibility();
            $this->emit('addActionIncident');
        } catch (\Throwable $th) {
            session()->flash('error', "Something goes wrong!!");
        }
    }
    public function emptyfield()
    {
        $this->description_incident = null;
        $this->followup_action = null;
        $this->action_condition = null;
        $this->actionee_comments = null;
        $this->responsibility = null;
        $this->report_to = null;
        $this->orginal_dueDate = null;
        $this->dueDate = null;
        $this->completion_date = null;
        $this->personal_reminder = null;
    }
}
