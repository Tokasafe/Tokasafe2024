<?php

namespace App\Http\Livewire\EventReportList\Insident;

use App\Models\People;
use Livewire\Component;
use App\Models\EventType;
use App\Models\Workgroup;
use App\Models\CompanyLevel;
use App\Models\EventSubType;
use App\Models\EventLocation;
use App\Models\IncidentReport;
use App\Models\PanelIncident;
use Livewire\WithFileUploads;

class Detail extends Component
{
    use WithFileUploads;
    public $data_id,$IncidentClose;
    public $event_type, $sub_type,$reference, $workgroup, $workgroup_id, $reporter_name, $reporter_name_id, $report_to, $report_to_id, $location, $date_event, $time_event, $potential_lti, $env_incident, $task, $description_incident, $involved_person, $involved_equipment, $preliminary_causes, $imediate_action_taken, $key_learning, $documentation;
    public $openWG = "modal", $open_ReportBy = "modal ", $open_ReportTo = "modal", $CompanyLevel = [], $radio_select = '', $ModalWorkgroup = [], $EventSubType = [], $showWG = false, $search_workgroup = '', $search_reportBy = '';
    public function mount($id)
    {
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
        $this->date_event =$incident->date_event;
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
        $this->documentation = $incident->documentation;
    }
    public function render()
    {
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
        return view('livewire.event-report-list.insident.detail',[
            'ReportBy' => People::with('Employer')->search(trim($this->search_reportBy))->paginate(100, ['*'], 'ReportByPage'),
            'ReportTo' => People::with('Employer')->search(trim($this->search_reportBy))->paginate(100, ['*'], 'ReportToPage'),
            'Location' => EventLocation::get(),
            'EventType' => EventType::where('eventCategory_id', 2)->get()
        ])->extends('navigation.homebase', ['header' => 'Incident Report', 'title' => 'incident', 'h1' => $this->data_id])->section('content');
    }
    public function updateStore()
    {

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
    }
    public function openReportTo()
    {
        $this->open_ReportTo  = "modal modal-open";
    }
    public function closeReportTo()
    {
        $this->open_ReportTo  = "modal";
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
}
