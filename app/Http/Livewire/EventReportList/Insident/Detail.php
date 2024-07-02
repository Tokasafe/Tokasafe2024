<?php

namespace App\Http\Livewire\EventReportList\Insident;

use App\Models\People;
use Livewire\Component;
use App\Models\EventType;
use App\Models\Workgroup;
use App\Models\CompanyLevel;
use App\Models\EventSubType;
use App\Models\EventLocation;
use App\Models\PanelIncident;
use Livewire\WithFileUploads;
use App\Models\IncidentReport;
use App\Models\RiskAssessment;
use App\Models\RiskLikelihood;
use App\Models\RiskConsequence;
use Livewire\WithPagination;

class Detail extends Component
{
    use WithFileUploads;
    use WithPagination;
   
    public $data_id, $delete_id, $IncidentClose, $filename,$wg_id,$search_companyLevel='',$search='',$show_reportTo = 'hidden', $show_reportBy = 'hidden';
    public $event_type, $sub_type, $reference, $workgroup, $workgroup_id, $reporter_name, $reporter_name_id, $report_to, $report_to_id, $location, $date_event, $time_event, $potential_lti, $env_incident, $task, $description_incident, $involved_person, $involved_equipment, $preliminary_causes, $imediate_action_taken, $key_learning, $documentation;
    public $openWG = "modal", $open_ReportBy = "modal ", $open_ReportTo = "modal", $modalDelete = "modal", $radio_select = '', $ModalWorkgroup = [], $EventSubType = [], $showWG = false, $search_workgroup = '', $search_reportBy = '', $fileUpload;
    public $actual_outcome, $notes_assessment, $potential_consequence, $name_assessment, $potential_likelihood, $investigation_req_assessment, $reporting_obligation_assessment, $actual_outcome_description, $potential_consequence_description, $potential_likelihood_description;

    public function mount( $id)
    {
       
        if (IncidentReport::whereId($id)->first()) {
            $this->data_id = $id;
            $close = PanelIncident::where('incident_report_id', $this->data_id)->first()->WorkflowStep->name;
            
            if ($close === 'Closed' || $close === 'Cancelled') {
                $this->IncidentClose = $close;
            }

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
            $this->date_event = date('d-m-Y',strtotime($incident->date_event));
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
        } else {
            return abort(404);
        }
    }
    public function render()
    {
        
       if (!empty($this->documentation)) {
            $file_name = $this->documentation->getClientOriginalName();
            $this->fileUpload  = pathinfo($file_name, PATHINFO_EXTENSION);
            $this->filename = null;
        }

        $this->ModalWorkgroup = (!empty($this->wg_id)) ? Workgroup::with(['CompanyLevel', 'CompanyLevel.BussinessUnit'])->searchWG(trim($this->search_workgroup))->searchWgId(trim($this->wg_id))->orderBy('companyLevel_id', 'asc')->get() : Workgroup::with(['CompanyLevel', 'CompanyLevel.BussinessUnit'])->searchWG(trim($this->search_workgroup))->orderBy('companyLevel_id', 'asc')->get();
        if ($this->event_type) {
            $this->EventSubType = EventSubType::where('eventType_id', $this->event_type)->get();
        }
        $this->click();
        $this->showReportTo();
        $this->showReportBy();
        $this->radioSelect();
        $this->riskAssessment();
        return view('livewire.event-report-list.insident.detail', [
            'ReportBy' => People::with('Employer')->search(trim($this->reporter_name))->paginate(100, ['*'], 'ReportByPage'),
            'ReportTo' => People::with('Employer')->search(trim($this->report_to))->paginate(100, ['*'], 'ReportToPage'),
            'Location' => EventLocation::get(),
            'EventType' => EventType::where('eventCategory_id', 2)->get(),
            'Consequence' => RiskConsequence::get(),
            'Likelihood' => RiskLikelihood::get(),
            'CompanyLevel' => CompanyLevel::with(['BussinessUnit'])->deptcont(trim($this->search_companyLevel))->orderBy('bussiness_unit', 'asc')->get()
        ])->extends('navigation.homebase', ['header' => 'Incident Report', 'title' => 'incident', 'h1' => $this->data_id])->section('content');
    }
    public function showReportTo()
    {
        if (empty($this->report_to)) {
            $this->show_reportTo = 'hidden';
            $this->reset('report_to_id');
        } elseif (!People::cari(trim($this->report_to))->first()) {
            $this->show_reportTo = 'block';
        } else {
            $this->show_reportTo = 'hidden';
        }
    }
    public function showReportBy()
    {
        if (empty($this->reporter_name)) {
            $this->show_reportBy = 'hidden';
            $this->reset('reporter_name_id');
        } elseif (!People::cari(trim($this->reporter_name))->first()) {
            $this->show_reportBy = 'block';
        } else {
            $this->show_reportBy = 'hidden';
        }
    }
    public function radioSelect()
    {
        if ($this->radio_select === 'workgroup') {
            $this->search_workgroup = $this->search;
            $this->wg_id = null;
            $this->search_companyLevel = "";
        } elseif ($this->radio_select === 'companyLevel') {
            $this->search_workgroup = "";
            $this->search_companyLevel = $this->search;
        } else {
            $this->search_workgroup = $this->search;
            $this->search_companyLevel = $this->search;
        }
    }
    public function riskAssessment()
    {
        $this->actual_outcome_description  = (!empty($this->actual_outcome)) ? RiskConsequence::whereId($this->actual_outcome)->first()->description : $this->actual_outcome_description = '';
        $this->potential_consequence_description  = (!empty($this->potential_consequence)) ? RiskConsequence::whereId($this->potential_consequence)->first()->description : $this->potential_consequence_description = '';
        $this->potential_likelihood_description  = (!empty($this->potential_likelihood)) ? RiskLikelihood::whereId($this->potential_likelihood)->first()->notes : $this->potential_likelihood_description = '';
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
        return redirect()->route('incidentDetails', ['id' =>  $this->data_id]);
        // session()->flash('success', 'Data updated Successfully!!');
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
        if ($id) {
            $this->wg_id = $id;
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
    public function deleteClose(){
        $this->modalDelete = "modal";
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
    // 
}
