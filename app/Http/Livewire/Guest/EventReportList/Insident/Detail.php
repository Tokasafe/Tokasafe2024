<?php

namespace App\Http\Livewire\Guest\EventReportList\Insident;

use App\Models\People;
use Livewire\Component;
use App\Models\EventType;
use App\Models\Workgroup;
use App\Models\CompanyLevel;
use App\Models\EventSubType;
use App\Models\UserSecurity;
use Livewire\WithPagination;
use App\Models\EventLocation;
use App\Models\PanelIncident;
use Livewire\WithFileUploads;
use App\Models\IncidentReport;
use App\Models\RiskAssessment;
use App\Models\RiskLikelihood;
use App\Models\RiskConsequence;

class Detail extends Component
{
    use WithFileUploads;
    use WithPagination;
    public $data_id, $delete_id, $IncidentClose, $filename, $WorkflowStep_name, $guest_respons = false, $id_people, $Event_Report_Manager,$assignTo,$also_assignTo;
    public $event_type, $sub_type, $reference, $workgroup, $workgroup_id, $reporter_name, $reporter_name_id, $report_to, $report_to_id, $location, $date_event, $time_event, $potential_lti, $env_incident, $task, $description_incident, $involved_person, $involved_equipment, $preliminary_causes, $imediate_action_taken, $key_learning, $documentation;
    public $openWG = "modal", $open_ReportBy = "modal ", $open_ReportTo = "modal", $modalDelete = "modal", $CompanyLevel = [], $radio_select = '', $ModalWorkgroup = [], $EventSubType = [], $showWG = false, $search_workgroup = '', $search_reportBy = '', $fileUpload;
    public $actual_outcome, $notes_assessment, $potential_consequence, $name_assessment, $potential_likelihood, $investigation_req_assessment, $reporting_obligation_assessment, $actual_outcome_description, $potential_consequence_description, $potential_likelihood_description;

    public function mount($id)
    {

        // dd($id);
        if (IncidentReport::whereId($id)->first()) {
            $this->data_id = $id;
            $close = PanelIncident::where('incident_report_id', $this->data_id)->first()->WorkflowStep->name; 
            if ($close === 'Closed' || $close === 'Cancelled') {
                $this->IncidentClose = $close;
            }
            $this->WorkflowStep_name = PanelIncident::where('incident_report_id', $this->data_id)->first()->WorkflowStep->name;
            
            $incident = IncidentReport::whereId($id)->first();
            $a = $incident->workgroup->CompanyLevel->BussinessUnit->name;
            $b = $incident->workgroup->CompanyLevel->deptORcont;
            $c = $incident->workgroup->job_class;
            $this->workgroup = "$a-$b-$c";
            $this->reference = $incident->reference;
            $this->date_event = $incident->date_event;
            $this->event_type = $incident->event_type;
            $this->sub_type = $incident->sub_type;
            $this->workgroup_id = $incident->workgroup_id;
            $this->reporter_name = $incident->repportBy->lookup_name;
            $this->reporter_name_id = $incident->reporter_name_id;
            $this->report_to_id = $incident->report_to_id;
            $this->report_to = $incident->repportTo->lookup_name;
            $this->location = $incident->location;
            $this->date_event = $incident->date_event;
            $this->time_event = $incident->time_event;
            $this->potential_lti = $incident->potential_lti;
            $this->env_incident = $incident->env_incident;
            $this->task = $incident->task;
            $this->description_incident = $incident->description_incident;
            $this->involved_person = $incident->involved_person;
            $this->involved_equipment = $incident->involved_equipment;
            $this->preliminary_causes = $incident->preliminary_causes;
            $this->imediate_action_taken = $incident->imediate_action_taken;
            $this->key_learning = $incident->key_learning;
            $this->actual_outcome = $incident->actual_outcome;
            $this->potential_consequence = $incident->potential_consequence;
            $this->potential_likelihood = $incident->potential_likelihood;
            $this->filename = $incident->documentation;
            $panel = PanelIncident::where('incident_report_id',$this->data_id)->first();
          
            if ($panel->assignTo) {
                $this->assignTo = $panel->assignTo;
            }
            if ($panel->also_assignTo) {
                $this->also_assignTo = $panel->also_assignTo;
            }
            if (!empty(People::whereIn('network_username', [auth()->user()->username])->first()->id)) {
                $this->id_people = People::whereIn('network_username', [auth()->user()->username])->first()->id;
                $workflow = UserSecurity::with('People')->where('user_id', $this->id_people)->whereIn('workflow', ['Moderator', 'Event Report Manager'])->pluck('workflow')->toArray();
                $nameStep = 'Assign & Investigation';
                if (in_array('Moderator', $workflow)) {
                    $this->guest_respons = true;
                } elseif (in_array('Event Report Manager', $workflow) && $this->WorkflowStep_name === $nameStep && $this->assignTo === $this->id_people) {
                    $this->guest_respons = true;
                } elseif (in_array('Event Report Manager', $workflow) && $this->WorkflowStep_name === $nameStep &&  $this->also_assignTo === $this->id_people) {
                    $this->guest_respons = true;
                } else {
                    $this->guest_respons = false;
                }
               
            } 
        } else {
            return abort(404);
        }
    }
    public function render()
    {
        $this->click();
        if (!empty($this->actual_outcome)) {
            $this->actual_outcome_description = RiskConsequence::whereId($this->actual_outcome)->first()->description;
        } else {
            $this->actual_outcome_description = '';
        }
        if (!empty($this->potential_consequence)) {
            $this->potential_consequence_description = RiskConsequence::whereId($this->potential_consequence)->first()->description;
        } else {
            $this->potential_consequence_description = '';
        }
        if (!empty($this->potential_likelihood)) {
            $this->potential_likelihood_description = RiskLikelihood::whereId($this->potential_likelihood)->first()->notes;
        } else {
            $this->potential_likelihood_description = '';
        }
        if (!empty($this->documentation)) {
            $file_name = $this->documentation->getClientOriginalName();
            $this->fileUpload  = pathinfo($file_name, PATHINFO_EXTENSION);
            $this->filename = null;
        }

        if (!empty($this->radio_select)) {
            if ($this->radio_select === 'companyLevel') {
                $this->showWG = false;
                $this->CompanyLevel = CompanyLevel::with(['BussinessUnit'])->deptcont(trim($this->search_workgroup))->orderBy('bussiness_unit', 'asc')->orderBy('level', 'desc')->get();
            } else {

                $this->showWG = true;
                $this->ModalWorkgroup = Workgroup::with(['CompanyLevel'])->searchWG(trim($this->search_workgroup))->orderBy('companyLevel_id', 'asc')->get();
            }
        } else {

            $this->CompanyLevel = CompanyLevel::with(['BussinessUnit'])->orderBy('bussiness_unit', 'asc')->orderBy('level', 'desc')->get();
        }
        if ($this->event_type) {
            $this->EventSubType = EventSubType::where('eventType_id', $this->event_type)->get();
        }
        return view('livewire.guest.event-report-list.insident.detail', [
            'ReportBy' => People::with('Employer')->search(trim($this->search_reportBy))->paginate(100, ['*'], 'ReportByPage'),
            'ReportTo' => People::with('Employer')->search(trim($this->search_reportBy))->paginate(100, ['*'], 'ReportToPage'),
            'Location' => EventLocation::get(),
            'EventType' => EventType::where('eventCategory_id', 2)->get(),
            'Consequence' => RiskConsequence::get(),
            'Likelihood' => RiskLikelihood::get(),
        ])->extends('navigation.guest.guestbase', ['header' => 'Incident Report', 'title' => 'incident', 'h1' => $this->data_id])->section('contentUser');
    }
    public function updateStore()
    {

        if (!$this->documentation) {
            $file_names = $this->filename;
        } else {

            $file_names = $this->documentation->getClientOriginalName();
            $this->documentation->storeAs('public/documents', $file_names);
        }
        $this->validate([
            'event_type' => 'required',
            'sub_type' => 'required',
            'workgroup' => 'required',
            'reporter_name' => 'required',
            'report_to' => 'required',
            'location' => 'required',
            'date_event' => 'required',
            'time_event' => 'required',
            'potential_lti' => 'required',
            'env_incident' => 'required',
            'task' => 'required',
            'description_incident' => 'required',
            'involved_person' => 'required',
            'involved_equipment' => 'required',
            'preliminary_causes' => 'required',
            'imediate_action_taken' => 'required',
            'key_learning' => 'required',
            'actual_outcome' => 'required',
            'potential_consequence' => 'required',
            'potential_likelihood' => 'required',
            'documentation' => 'nullable|mimes:jpg,jpeg,png,svg,gif,xlsx,pdf,docx,PNG'
        ]);
        IncidentReport::whereId($this->data_id)->update([
            'event_type' => $this->event_type,
            'sub_type' => $this->sub_type,
            'workgroup_id' => $this->workgroup_id,
            'reporter_name_id' => $this->reporter_name_id,
            'report_to_id' => $this->report_to_id,
            'location' => $this->location,
            'date_event' => date('Y-m-d', strtotime($this->date_event)),
            'time_event' => $this->time_event,
            'potential_lti' => $this->potential_lti,
            'env_incident' => $this->env_incident,
            'task' => $this->task,
            'description_incident' => $this->description_incident,
            'involved_person' => $this->involved_person,
            'involved_equipment' => $this->involved_equipment,
            'preliminary_causes' => $this->preliminary_causes,
            'imediate_action_taken' => $this->imediate_action_taken,
            'key_learning' => $this->key_learning,
            'actual_outcome' => $this->actual_outcome,
            'potential_consequence' => $this->potential_consequence,
            'potential_likelihood' => $this->potential_likelihood,
            'reference' => $this->reference,
            'documentation' => $file_names
        ]);
        // return redirect()->route('incidentDetailsGuest', ['id' =>  $this->data_id]);
        session()->flash('success', 'Data updated Successfully!!');
    }

    public function download()
    {
        $name = IncidentReport::whereId($this->data_id)->first()->documentation;
        return response()->download(storage_path('app/public/documents/' . $name));
    }
    public function openWokrgroup()
    {
        $this->openWG = "modal modal-open";
    }
    public function openReportBy()
    {
        $this->open_ReportBy  = "modal modal-open";
    }
    public function closeReportBy()
    {
        $this->open_ReportBy  = "modal";
        $this->search_reportBy = "";
    }
    public function openReportTo()
    {
        $this->open_ReportTo  = "modal modal-open";
    }
    public function closeReportTo()
    {
        $this->open_ReportTo  = "modal";
        $this->search_reportBy = "";
    }
    public function closeWokrgroup()
    {
        $this->openWG = "modal ";
    }
    public function cariPelapor($id)
    {
        if ($id) {
            $this->reporter_name_id = $id;
            $this->reporter_name = People::whereId($id)->first()->lookup_name;
            $this->closeReportBy();
        }
    }
    public function cariReportTo($id)
    {
        if ($id) {
            $this->report_to_id = $id;
            $this->report_to = People::whereId($id)->first()->lookup_name;
            $this->closeReportTo();
        }
    }
    public function cariCL($id)
    {
        // dd($id);
        $this->radio_select = '';
        $this->showWG = true;
        if (!empty($id)) {
            $id_Dept = CompanyLevel::with(['BussinessUnit'])->where('id', $id)->first()->id;
            $this->ModalWorkgroup = Workgroup::with(['CompanyLevel'])->where('companyLevel_id', $id_Dept)->get();
        } else {
            $this->ModalWorkgroup = Workgroup::with(['CompanyLevel'])->get();
        }
    }
    public function clickWorkgroup($id, $bu, $deptOrCont, $job_class)
    {
        $this->workgroup_id = $id;
        $this->workgroup = "$bu-$deptOrCont-$job_class";
        $this->closeWokrgroup();
    }

    public function delete()
    {
        $this->modalDelete = "modal modal-open";
    }
    public function deleteFileAction()
    {
        try {
            $this->modalDelete = "modal";
            IncidentReport::find($this->data_id)->delete();
            return redirect()->route('incident');
        } catch (\Exception $e) {
            session()->flash('error', "Something goes wrong!!");
        }
    }

    // ClickFunction
    public function click()
    {
        if ($this->potential_consequence == 5 && $this->potential_likelihood == 1) {
            $this->btn_a1();
        }
        if ($this->potential_consequence == 4 && $this->potential_likelihood == 1) {
            $this->btn_a2();
        }
        if ($this->potential_consequence == 3 && $this->potential_likelihood == 1) {
            $this->btn_a3();
        }
        if ($this->potential_consequence == 2 && $this->potential_likelihood == 1) {
            $this->btn_a4();
        }
        if ($this->potential_consequence == 1 && $this->potential_likelihood == 1) {
            $this->btn_a5();
        }
        if ($this->potential_consequence == 5 && $this->potential_likelihood == 2) {
            $this->btn_b1();
        }
        if ($this->potential_consequence == 4 && $this->potential_likelihood == 2) {
            $this->btn_b2();
        }
        if ($this->potential_consequence == 3 && $this->potential_likelihood == 2) {
            $this->btn_b3();
        }
        if ($this->potential_consequence == 2 && $this->potential_likelihood == 2) {
            $this->btn_b4();
        }
        if ($this->potential_consequence == 1 && $this->potential_likelihood == 2) {
            $this->btn_b5();
        }
        if ($this->potential_consequence == 5 && $this->potential_likelihood == 3) {
            $this->btn_c1();
        }
        if ($this->potential_consequence == 4 && $this->potential_likelihood == 3) {
            $this->btn_c2();
        }
        if ($this->potential_consequence == 3 && $this->potential_likelihood == 3) {
            $this->btn_c3();
        }
        if ($this->potential_consequence == 2 && $this->potential_likelihood == 3) {
            $this->btn_c4();
        }
        if ($this->potential_consequence == 1 && $this->potential_likelihood == 3) {
            $this->btn_c5();
        }
        if ($this->potential_consequence == 5 && $this->potential_likelihood == 4) {
            $this->btn_d1();
        }
        if ($this->potential_consequence == 4 && $this->potential_likelihood == 4) {
            $this->btn_d2();
        }
        if ($this->potential_consequence == 3 && $this->potential_likelihood == 4) {
            $this->btn_d3();
        }
        if ($this->potential_consequence == 2 && $this->potential_likelihood == 4) {
            $this->btn_d4();
        }
        if ($this->potential_consequence == 1 && $this->potential_likelihood == 4) {
            $this->btn_d5();
        }
        if ($this->potential_consequence == 5 && $this->potential_likelihood == 5) {
            $this->btn_e1();
        }
        if ($this->potential_consequence == 4 && $this->potential_likelihood == 5) {
            $this->btn_e2();
        }
        if ($this->potential_consequence == 3 && $this->potential_likelihood == 5) {
            $this->btn_e3();
        }
        if ($this->potential_consequence == 2 && $this->potential_likelihood == 5) {
            $this->btn_e4();
        }
        if ($this->potential_consequence == 1 && $this->potential_likelihood == 5) {
            $this->btn_e5();
        }
    }
    // FUNCTION BTN INITIAL RISK
    public function btn_a1()
    {
        $this->potential_consequence = 5;
        $this->potential_likelihood = 1;
        $assessment = RiskAssessment::whereId(1)->first();
        $this->name_assessment = $assessment->name;
        $this->notes_assessment = $assessment->notes;
        $this->investigation_req_assessment = $assessment->investigation_req;
        $this->reporting_obligation_assessment = $assessment->reporting_obligation;
    }
    public function btn_a2()
    {
        $this->potential_consequence = 4;
        $this->potential_likelihood = 1;
        $assessment = RiskAssessment::whereId(1)->first();
        $this->name_assessment = $assessment->name;
        $this->notes_assessment = $assessment->notes;
        $this->investigation_req_assessment = $assessment->investigation_req;
        $this->reporting_obligation_assessment = $assessment->reporting_obligation;
    }
    public function btn_a3()
    {
        $this->potential_consequence = 3;
        $this->potential_likelihood = 1;
        $assessment = RiskAssessment::whereId(1)->first();
        $this->name_assessment = $assessment->name;
        $this->notes_assessment = $assessment->notes;
        $this->investigation_req_assessment = $assessment->investigation_req;
        $this->reporting_obligation_assessment = $assessment->reporting_obligation;
    }
    public function btn_a4()
    {
        $this->potential_consequence = 2;
        $this->potential_likelihood = 1;
        $assessment = RiskAssessment::whereId(2)->first();
        $this->name_assessment = $assessment->name;
        $this->notes_assessment = $assessment->notes;
        $this->investigation_req_assessment = $assessment->investigation_req;
        $this->reporting_obligation_assessment = $assessment->reporting_obligation;
    }
    public function btn_a5()
    {
        $this->potential_consequence = 1;
        $this->potential_likelihood = 1;
        $assessment = RiskAssessment::whereId(2)->first();
        $this->name_assessment = $assessment->name;
        $this->notes_assessment = $assessment->notes;
        $this->investigation_req_assessment = $assessment->investigation_req;
        $this->reporting_obligation_assessment = $assessment->reporting_obligation;
    }
    // BUTTON B
    public function btn_b1()
    {
        $this->potential_consequence = 5;
        $this->potential_likelihood = 2;
        $assessment = RiskAssessment::whereId(1)->first();
        $this->name_assessment = $assessment->name;
        $this->notes_assessment = $assessment->notes;
        $this->investigation_req_assessment = $assessment->investigation_req;
        $this->reporting_obligation_assessment = $assessment->reporting_obligation;
    }
    public function btn_b2()
    {
        $this->potential_consequence = 4;
        $this->potential_likelihood = 2;
        $assessment = RiskAssessment::whereId(1)->first();
        $this->name_assessment = $assessment->name;
        $this->notes_assessment = $assessment->notes;
        $this->investigation_req_assessment = $assessment->investigation_req;
        $this->reporting_obligation_assessment = $assessment->reporting_obligation;
    }
    public function btn_b3()
    {
        $this->potential_consequence = 3;
        $this->potential_likelihood = 2;
        $assessment = RiskAssessment::whereId(2)->first();
        $this->name_assessment = $assessment->name;
        $this->notes_assessment = $assessment->notes;
        $this->investigation_req_assessment = $assessment->investigation_req;
        $this->reporting_obligation_assessment = $assessment->reporting_obligation;
    }
    public function btn_b4()
    {
        $this->potential_consequence = 2;
        $this->potential_likelihood = 2;
        $assessment = RiskAssessment::whereId(2)->first();
        $this->name_assessment = $assessment->name;
        $this->notes_assessment = $assessment->notes;
        $this->investigation_req_assessment = $assessment->investigation_req;
        $this->reporting_obligation_assessment = $assessment->reporting_obligation;
    }
    public function btn_b5()
    {
        $this->potential_consequence = 1;
        $this->potential_likelihood = 2;
        $assessment = RiskAssessment::whereId(3)->first();
        $this->name_assessment = $assessment->name;
        $this->notes_assessment = $assessment->notes;
        $this->investigation_req_assessment = $assessment->investigation_req;
        $this->reporting_obligation_assessment = $assessment->reporting_obligation;
    }
    // BUTTON C
    public function btn_c1()
    {
        $this->potential_consequence = 5;
        $this->potential_likelihood = 3;

        $assessment = RiskAssessment::whereId(1)->first();
        $this->name_assessment = $assessment->name;
        $this->notes_assessment = $assessment->notes;
        $this->investigation_req_assessment = $assessment->investigation_req;
        $this->reporting_obligation_assessment = $assessment->reporting_obligation;
    }
    public function btn_c2()
    {
        $this->potential_consequence = 4;
        $this->potential_likelihood = 3;

        $assessment = RiskAssessment::whereId(1)->first();
        $this->name_assessment = $assessment->name;
        $this->notes_assessment = $assessment->notes;
        $this->investigation_req_assessment = $assessment->investigation_req;
        $this->reporting_obligation_assessment = $assessment->reporting_obligation;
    }
    public function btn_c3()
    {
        $this->potential_consequence = 3;
        $this->potential_likelihood = 3;
        $assessment = RiskAssessment::whereId(2)->first();
        $this->name_assessment = $assessment->name;
        $this->notes_assessment = $assessment->notes;
        $this->investigation_req_assessment = $assessment->investigation_req;
        $this->reporting_obligation_assessment = $assessment->reporting_obligation;
    }
    public function btn_c4()
    {
        $this->potential_consequence = 2;
        $this->potential_likelihood = 3;
        $assessment = RiskAssessment::whereId(3)->first();
        $this->name_assessment = $assessment->name;
        $this->notes_assessment = $assessment->notes;
        $this->investigation_req_assessment = $assessment->investigation_req;
        $this->reporting_obligation_assessment = $assessment->reporting_obligation;
    }
    public function btn_c5()
    {
        $this->potential_consequence = 1;
        $this->potential_likelihood = 3;
        $assessment = RiskAssessment::whereId(4)->first();
        $this->name_assessment = $assessment->name;
        $this->notes_assessment = $assessment->notes;
        $this->investigation_req_assessment = $assessment->investigation_req;
        $this->reporting_obligation_assessment = $assessment->reporting_obligation;
    }
    // BUTTON D
    public function btn_d1()
    {
        $this->potential_consequence = 5;
        $this->potential_likelihood = 4;
        $assessment = RiskAssessment::whereId(1)->first();
        $this->name_assessment = $assessment->name;
        $this->notes_assessment = $assessment->notes;
        $this->investigation_req_assessment = $assessment->investigation_req;
        $this->reporting_obligation_assessment = $assessment->reporting_obligation;
    }
    public function btn_d2()
    {
        $this->potential_consequence = 4;
        $this->potential_likelihood = 4;
        $assessment = RiskAssessment::whereId(2)->first();
        $this->name_assessment = $assessment->name;
        $this->notes_assessment = $assessment->notes;
        $this->investigation_req_assessment = $assessment->investigation_req;
        $this->reporting_obligation_assessment = $assessment->reporting_obligation;
    }
    public function btn_d3()
    {
        $this->potential_consequence = 3;
        $this->potential_likelihood = 4;
        $assessment = RiskAssessment::whereId(3)->first();
        $this->name_assessment = $assessment->name;
        $this->notes_assessment = $assessment->notes;
        $this->investigation_req_assessment = $assessment->investigation_req;
        $this->reporting_obligation_assessment = $assessment->reporting_obligation;
    }
    public function btn_d4()
    {
        $this->potential_consequence = 2;
        $this->potential_likelihood = 4;
        $assessment = RiskAssessment::whereId(4)->first();
        $this->name_assessment = $assessment->name;
        $this->notes_assessment = $assessment->notes;
        $this->investigation_req_assessment = $assessment->investigation_req;
        $this->reporting_obligation_assessment = $assessment->reporting_obligation;
    }
    public function btn_d5()
    {
        $this->potential_consequence = 1;
        $this->potential_likelihood = 4;
        $assessment = RiskAssessment::whereId(4)->first();
        $this->name_assessment = $assessment->name;
        $this->notes_assessment = $assessment->notes;
        $this->investigation_req_assessment = $assessment->investigation_req;
        $this->reporting_obligation_assessment = $assessment->reporting_obligation;
    }
    // BUTTON E
    public function btn_e1()
    {
        $this->potential_consequence = 5;
        $this->potential_likelihood = 5;
        $assessment = RiskAssessment::whereId(2)->first();
        $this->name_assessment = $assessment->name;
        $this->notes_assessment = $assessment->notes;
        $this->investigation_req_assessment = $assessment->investigation_req;
        $this->reporting_obligation_assessment = $assessment->reporting_obligation;
    }
    public function btn_e2()
    {
        $this->potential_consequence = 4;
        $this->potential_likelihood = 5;
        $assessment = RiskAssessment::whereId(2)->first();
        $this->name_assessment = $assessment->name;
        $this->notes_assessment = $assessment->notes;
        $this->investigation_req_assessment = $assessment->investigation_req;
        $this->reporting_obligation_assessment = $assessment->reporting_obligation;
    }
    public function btn_e3()
    {
        $this->potential_consequence = 3;
        $this->potential_likelihood = 5;
        $assessment = RiskAssessment::whereId(3)->first();
        $this->name_assessment = $assessment->name;
        $this->notes_assessment = $assessment->notes;
        $this->investigation_req_assessment = $assessment->investigation_req;
        $this->reporting_obligation_assessment = $assessment->reporting_obligation;
    }
    public function btn_e4()
    {
        $this->potential_consequence = 2;
        $this->potential_likelihood = 5;
        $assessment = RiskAssessment::whereId(4)->first();
        $this->name_assessment = $assessment->name;
        $this->notes_assessment = $assessment->notes;
        $this->investigation_req_assessment = $assessment->investigation_req;
        $this->reporting_obligation_assessment = $assessment->reporting_obligation;
    }
    public function btn_e5()
    {
        $this->potential_consequence = 1;
        $this->potential_likelihood = 5;
        $assessment = RiskAssessment::whereId(4)->first();
        $this->name_assessment = $assessment->name;
        $this->notes_assessment = $assessment->notes;
        $this->investigation_req_assessment = $assessment->investigation_req;
        $this->reporting_obligation_assessment = $assessment->reporting_obligation;
    }
}
