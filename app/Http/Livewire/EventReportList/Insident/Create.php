<?php

namespace App\Http\Livewire\EventReportList\Insident;

use App\Models\People;
use Livewire\Component;
use App\Models\EventType;
use App\Models\Workgroup;
use Illuminate\Support\Str;
use App\Models\CompanyLevel;
use App\Models\EventSubType;
use App\Models\WorkflowStep;
use Livewire\WithPagination;
use App\Models\EventLocation;
use App\Models\PanelHazardId;
use App\Models\PanelIncident;
use Livewire\WithFileUploads;
use App\Models\IncidentReport;
use App\Traits\CustomWithPagination;
use App\Models\WorkflowAdministration;

class Create extends Component
{
    use WithPagination;
    use WithFileUploads;
    public $event_type, $sub_type, $workgroup, $workgroup_id, $reporter_name, $reporter_name_id, $report_to, $report_to_id, $location, $date_event, $time_event, $potential_lti, $env_incident, $task, $description_incident, $involved_person, $involved_equipment, $preliminary_causes, $imediate_action_taken, $key_learning, $documentation;
    public $openWG = "modal", $open_ReportBy = "modal ", $open_ReportTo = "modal", $CompanyLevel = [], $radio_select = '', $ModalWorkgroup = [], $EventSubType = [], $showWG = false, $search_workgroup = '', $search_reportBy = '',$fileUpload;
   public function btnCloseFile(){
    
   }
    public function render()
    {
        if ($this->documentation) {
            $file_name = $this->documentation->getClientOriginalName();
            $this->fileUpload=pathinfo($file_name, PATHINFO_EXTENSION);  
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

        return view('livewire.event-report-list.insident.create', [
            'ReportBy' => People::with('Employer')->search(trim($this->search_reportBy))->paginate(100, ['*'], 'ReportByPage'),
            'ReportTo' => People::with('Employer')->search(trim($this->search_reportBy))->paginate(100, ['*'], 'ReportToPage'),
            'Location' => EventLocation::get(),
            'EventType' => EventType::where('eventCategory_id', 2)->get()
        ]);
    }
    public function store()
    {
        $incident = IncidentReport::latest()->first();
       
        $referenceIncident="TT–OHS–FO–60–017A";
        if ($incident==null) {
           $reference=0001;
        } else {
            $reference = $incident->id +1;
           
            $reference =  str_pad($reference,4,"0",STR_PAD_LEFT);
        }
        $referenceCode = $referenceIncident.$reference;
        if (!empty($this->documentation)) {
            $file_name = $this->documentation->getClientOriginalName();
            $this->fileUpload=pathinfo($file_name, PATHINFO_EXTENSION);
            dd( $this->fileUpload);
            $this->documentation->storeAs('public/documents', $file_name);
            
        } else {
            $file_name = "";
            
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
            'documentation' => 'nullable|mimes:jpg,jpeg,png,svg,gif,xlsx,pdf,docx,PNG'
        ]);

        $incidentReport = IncidentReport::create([
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
            'reference'=>$referenceCode,
            'documentation' => $file_name
        ]);
        if ($incidentReport) {
            $this->dispatchBrowserEvent('articleStore');
            $this->emptyfields();
            $this->emit('IncidentTable');
            session()->flash('success', 'Data added Successfully!!');
            $workflow_template_id = WorkflowStep::where('workflow_template', 1)->orderBy('id', 'ASC')->first()->workflow_template;
            $description = WorkflowAdministration::with(['StatusCode', 'ResponsibleRole'])->where('workflow_template', $workflow_template_id)->first()->description;
            $b = WorkflowAdministration::with(['StatusCode', 'ResponsibleRole'])->where('description', $description)->first()->id;
            PanelIncident::create([
                'assignTo' => null,
                'also_assignTo' => null,
                'incident_report_id' => $incidentReport->id,
                'workflow_step' => $b,
    
            ]);
        }
    }
    public function generateUniqueCode()
    {
        do {
            $code = (string) random_int(100000, 999999);
        } while (IncidentReport::where('reference', '=', $code)->first());

        return $code;
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
    public function emptyfields()
    {
        $this->event_type = null;
        $this->sub_type = null;
        $this->workgroup_id = null;
        $this->workgroup = null;
        $this->reporter_name = null;
        $this->reporter_name_id = null;
        $this->report_to_id = null;
        $this->report_to = null;
        $this->location = null;
        $this->date_event = null;
        $this->time_event = null;
        $this->potential_lti = null;
        $this->env_incident = null;
        $this->task = null;
    }
}
