<?php

namespace App\Http\Livewire\EventReportList\Insident\Action;

use Carbon\Carbon;
use App\Models\User;
use App\Models\People;
use Livewire\Component;
use App\Models\UserSecurity;
use App\Models\WorkflowStep;
use App\Models\PanelIncident;
use App\Models\IncidentAction;
use App\Models\IncidentReport;
use App\Notifications\ToModerator;
use App\Notifications\ToSupervisor;
use App\Models\WorkflowAdministration;
use Illuminate\Support\Facades\Notification;

class CreateOne extends Component
{

    public $description_incident, $followup_action, $actionee_comments, $incident_report_id, $action_condition, $orginal_dueDate, $responsibility, $dueDate, $completion_date, $personal_reminder;
    public $data_id, $IncidentClose, $open_Responsibility = "modal", $search_reportBy = '', $report_to, $event_type, $event_type_name, $reporter_name, $reference,$key_learning,$username;
    protected $listeners = [

        'pasing_id_incident'
    ];

    public function pasing_id_incident($value)
    {
        if ($value) {
            
            $this->data_id  = $value;
            $incident = IncidentReport::whereId($this->data_id)->first();
            $this->reporter_name = $incident->repportBy->lookup_name;
            $this->username = $incident->repportTo->network_username;
            $this->report_to = $incident->repportTo->lookup_name;
            $this->event_type = $incident->event_type;
            $this->reference = $incident->reference;
            $this->event_type_name = $incident->eventType->name;
           
           
        }
    }
    public function render()
    {
        return view('livewire.event-report-list.insident.action.create-one', [
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
            $this->report_to = People::find($id)->lookup_name;
            $this->closeResponsibility();
        } else {
            $this->responsibility = null;
            $this->report_to = null;
        }
    }
    public function storeAction()
    {
        if ($this->orginal_dueDate) {
            $this->orginal_dueDate = date('Y-m-d', strtotime($this->orginal_dueDate));
        } else {
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

            $this->personal_reminder = date('Y-m-d', strtotime($this->personal_reminder));
        } else {
            $this->personal_reminder = null;
        }

        $this->validate([
            'description_incident' => 'nullable',
            'followup_action' => 'required',
            'actionee_comments' => 'nullable',
            'action_condition' => 'nullable',
            'report_to' => 'required',
            'orginal_dueDate' => 'nullable',
            'dueDate' => 'nullable',
            'completion_date' => 'nullable',
            'personal_reminder' => 'nullable',
            'incident_report_id' => 'nullable',
            'key_learning' => 'required',
        ]);


        // try {
        IncidentAction::create([
            'description_incident' => $this->description_incident,
            'followup_action' => $this->followup_action,
            'actionee_comments' => $this->actionee_comments,
            'action_condition' => $this->action_condition,
            'responsibility' => $this->responsibility,
            'orginal_dueDate' => date('Y-m-d', strtotime($this->orginal_dueDate)),
            'dueDate' => date('Y-m-d', strtotime($this->dueDate)),
            'completion_date' => date('Y-m-d', strtotime($this->completion_date)),
            'personal_reminder' => date('Y-m-d', strtotime($this->personal_reminder)),
            'incident_report_id' => $this->data_id,
        ]);
        IncidentReport::updateOrCreate(['id'=>$this->data_id],['key_learning' => $this->key_learning]);

        $workflow_template_id = WorkflowStep::where('workflow_template', 2)->orderBy('id', 'ASC')->first()->workflow_template;
        $description = WorkflowAdministration::with(['StatusCode', 'ResponsibleRole'])->where('workflow_template', $workflow_template_id)->first()->description;
        $b = WorkflowAdministration::with(['StatusCode', 'ResponsibleRole'])->where('description', $description)->first()->id;
        PanelIncident::create([
            'assignTo' => null,
            'also_assignTo' => null,
            'incident_report_id' => $this->data_id,
            'workflow_step' => $b,
        ]);
        $url = $this->data_id;
        
        $network_username = People::whereIn('network_username', User::get('username'))->pluck('id')->toArray();
        $id_moderator = UserSecurity::whereIn('user_id', $network_username)->where('user_id', 'NOT LIKE', auth()->user()->id)->where('event_types_id', $this->event_type)->where('workflow', 'Moderator')->pluck('user_id')->toArray();
        $EventType = $this->event_type_name;
        $people = People::whereIn('id', $id_moderator)->pluck('network_username')->toArray();
        $moderator = User::whereIn('username', $people)->get();
        $reportTo  = $this->username;
        if ($reportTo) {
            $pengawas = User::where('username', $reportTo)->get();
            $offerDataSpv = [
                'name' => 'Hi,' . $this->report_to,
                'subject' => $EventType,
                'body' => $this->reporter_name . ' ' . 'sent you an incident report',
                'thanks' => 'Thank you',
                'offerText' => $this->reference,
                'offerUrl' => url("http://tokasafe.tokatindung.com/eventReport/incident/$url"),
                'offer_id' => $url,
                'dateTime' => Carbon::now(+8)->toDateTimeString()
            ];
            Notification::send($pengawas, new ToSupervisor($offerDataSpv));
        }
        $offerData = [
            'name' => 'Hi,' . $this->report_to,
            'subject' => $EventType,
            'body' => $this->reporter_name . ' ' . 'sent you an incident report',
            'thanks' => 'Thank you',
            'offerText' => $this->reference,
            'offerUrl' => url("http://tokasafe.tokatindung.com/eventReport/incident/$url"),
            'offer_id' => $url,
            'dateTime' => Carbon::now(+8)->toDateTimeString()
        ];
        Notification::send($moderator, new ToModerator($offerData));

        $this->dispatchBrowserEvent('articleStore');
        $this->emptyfield();
        $this->emit('IncidentTable');
        $this->closeResponsibility();
        $this->emit('addActionIncident');
        return redirect()->route('incidentDetails', ['id' =>  $this->data_id]);
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
    public function backTabIncident()
    {
        $this->emit('backTabIncidents', $this->data_id);
    }
}
