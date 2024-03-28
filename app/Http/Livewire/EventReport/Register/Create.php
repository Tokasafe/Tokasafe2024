<?php

namespace App\Http\Livewire\EventReport\Register;

use App\Mail\CreateEventReport;
use App\Mail\ReportBy;
use App\Models\AccessRiskAssessment;
use App\Models\Companies;
use App\Models\CompanyLevel;
use App\Models\EventLocation;
use App\Models\EventReport;
use App\Models\EventSite;
use App\Models\EventSubType;
use App\Models\EventType;
use App\Models\People;
use App\Models\RiskAssessment;
use App\Models\RiskConsequence;
use App\Models\RiskLikelihood;
use App\Models\StatusEvent;
use App\Models\User;
use App\Models\UserSecurity;
use App\Models\WorkflowAdministration;
use App\Models\WorkflowStep;
use App\Models\Workgroup;
use Illuminate\Support\Facades\Mail;
use Livewire\Component;
use Vinkla\Hashids\Facades\Hashids;

class Create extends Component
{
    public $openModalWG = '';
    public $openModalreportBy = '';
    public $openModalreportTo = '';
    public $openModalResponsibleCompany = '';

    public $type_kejadian;
    public $jenis_kejadian;
    public $workgroup;
    public $workgroup_id;
    public $report_by;
    public $report_to;
    public $tgl_kejadian;
    public $tgl_dilaporkan;
    public $waktu_kejadian;
    public $lokasi_kejadian;
    public $site_name;
    public $contract_area;
    public $occupation;
    public $immediate;
    public $explanation;
    public $actual_outcome;
    public $potential_consequence;
    public $potential_likelihood;
    public $actual_outcome_description = '';
    public $potential_consequence_description = '';
    public $potential_likelihood_description = '';

    public $name_assessment;
    public $notes_assessment;
    public $investigation_req_assessment;
    public $reporting_obligation_assessment;
    public $id_assessment;

    public $ModalWorkgroup = [];
    public $CompanyLevel = [];
    public $SubType = [];
    public $radio_select;
    public $statusER;
    public $search_workgroup = '';
    public $search_company = '';
    public $search_reportBy = '';
    public $search_reportTo = '';
    public $search_reportTo_id;
    public $showWG = true;
    public $showDataInput = false;
    public $showAccess = false;

    public function render()
    {
        if (empty($this->report_by)) {
            if (!empty(People::where('network_username', auth()->user()->username)->first()->lookup_name)) {
                # code...
                $this->report_by = People::where('network_username', auth()->user()->username)->first()->lookup_name;
            }
        }
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

        if (!empty($this->type_kejadian)) {
            $this->SubType = EventSubType::with('EventType')->where('eventType_id', $this->type_kejadian)->get();
            if (!empty(AccessRiskAssessment::with('EventType')->whereIn('event_type_id', [$this->type_kejadian])->first()->event_type_id)) {
                $this->showAccess = true;
            } else {
                $this->showAccess = false;
            }

        }
        if ($this->type_kejadian==1) {
            $this->showDataInput=true;
        }
        else{
            $this->showDataInput=false;
        }

        if (!empty($this->radio_select)) {
            if ($this->radio_select == 'companyLevel') {
                $this->CompanyLevel = CompanyLevel::with(['BussinessUnit'])->deptcont(trim($this->search_workgroup))->orderBy('bussiness_unit', 'asc')->orderBy('level', 'desc')->get();
            } else {
                if ($this->showWG == true) {
                    $this->ModalWorkgroup = Workgroup::with(['CompanyLevel'])->searchWG(trim($this->search_workgroup))->orderBy('companyLevel_id', 'asc')->get();
                }
            }
        } else {

            $this->CompanyLevel = CompanyLevel::with(['BussinessUnit'])->orderBy('bussiness_unit', 'asc')->orderBy('level', 'desc')->get();
        }

        return view('livewire.event-report.register.create', [
            'Eventype' => EventType::with(['EventCategory'])->orderBy('eventCategory_id', 'ASC')->get(),
            'People' => People::with('Employer')->search(trim($this->search_reportBy))->searchto(trim($this->search_reportTo))->get(),
            'Company' => Companies::with(['CompanyCategory'])->searchcompany(trim($this->search_company))->get(),
            'Consequence' => RiskConsequence::get(),
            'Likelihood' => RiskLikelihood::get(),
            'LocationEvent' => EventLocation::get(),
            'EventSite' => EventSite::get(),
        ]);
    }
    public function click()
    {
        if ($this->potential_consequence == 6 && $this->potential_likelihood == 1) {
            $this->btn_a1();
        }
        if ($this->potential_consequence == 5 && $this->potential_likelihood == 1) {
            $this->btn_a2();
        }
        if ($this->potential_consequence == 4 && $this->potential_likelihood == 1) {
            $this->btn_a3();
        }
        if ($this->potential_consequence == 3 && $this->potential_likelihood == 1) {
            $this->btn_a4();
        }
        if ($this->potential_consequence == 2 && $this->potential_likelihood == 1) {
            $this->btn_a5();
        }
        if ($this->potential_consequence == 6 && $this->potential_likelihood == 2) {
            $this->btn_b1();
        }
        if ($this->potential_consequence == 5 && $this->potential_likelihood == 2) {
            $this->btn_b2();
        }
        if ($this->potential_consequence == 4 && $this->potential_likelihood == 2) {
            $this->btn_b3();
        }
        if ($this->potential_consequence == 3 && $this->potential_likelihood == 2) {
            $this->btn_b4();
        }
        if ($this->potential_consequence == 2 && $this->potential_likelihood == 2) {
            $this->btn_b5();
        }
        if ($this->potential_consequence == 6 && $this->potential_likelihood == 3) {
            $this->btn_c1();
        }
        if ($this->potential_consequence == 5 && $this->potential_likelihood == 3) {
            $this->btn_c2();
        }
        if ($this->potential_consequence == 4 && $this->potential_likelihood == 3) {
            $this->btn_c3();
        }
        if ($this->potential_consequence == 3 && $this->potential_likelihood == 3) {
            $this->btn_c4();
        }
        if ($this->potential_consequence == 2 && $this->potential_likelihood == 3) {
            $this->btn_c5();
        }
        if ($this->potential_consequence == 6 && $this->potential_likelihood == 4) {
            $this->btn_d1();
        }
        if ($this->potential_consequence == 5 && $this->potential_likelihood == 4) {
            $this->btn_d2();
        }
        if ($this->potential_consequence == 4 && $this->potential_likelihood == 4) {
            $this->btn_d3();
        }
        if ($this->potential_consequence == 3 && $this->potential_likelihood == 4) {
            $this->btn_d4();
        }
        if ($this->potential_consequence == 2 && $this->potential_likelihood == 4) {
            $this->btn_d5();
        }
        if ($this->potential_consequence == 6 && $this->potential_likelihood == 6) {
            $this->btn_e1();
        }
        if ($this->potential_consequence == 5 && $this->potential_likelihood == 6) {
            $this->btn_e2();
        }
        if ($this->potential_consequence == 4 && $this->potential_likelihood == 6) {
            $this->btn_e3();
        }
        if ($this->potential_consequence == 3 && $this->potential_likelihood == 6) {
            $this->btn_e4();
        }
        if ($this->potential_consequence == 2 && $this->potential_likelihood == 6) {
            $this->btn_e5();
        }
    }
    public function cari($id)
    {
        $this->showWG = false;
        if (!empty($id)) {
            $id_Dept = CompanyLevel::with(['BussinessUnit'])->where('id', $id)->first()->id;
            $this->ModalWorkgroup = Workgroup::with(['CompanyLevel'])->where('companyLevel_id', $id_Dept)->get();
        } else {
            $this->ModalWorkgroup = Workgroup::with(['CompanyLevel'])->get();
        }
    }
    public function workGroup($id, $bu, $deptOrCont, $job_class)
    {
        $this->workgroup_id = $id;
        $this->workgroup = "$bu-$deptOrCont-$job_class";
        $this->wgClickClose();
    }
    public function cari_reportBy($id)
    {

        if (!empty($id)) {
            $reportBy = People::with('Employer')->whereId($id)->first();
            $this->report_by = $reportBy->lookup_name;
            $this->reportByClickClose();
        }
    }
    public function cari_reportTo($id)
    {

        if (!empty($id)) {
            $reportTo = People::with('Employer')->whereId($id)->first();
            $this->report_to = $reportTo->lookup_name;
            $this->search_reportTo_id = $reportTo->id;

            $this->reportToClickClose();
        }
    }

    public function clearSearchWg()
    {
        $this->search_workgroup = '';
        $this->radio_select = '';
        $this->search_reportBy = '';
        $this->search_reportTo = '';
        $this->search_company = '';
    }

    public function store()
    {

        if (!empty(AccessRiskAssessment::with('EventType')->whereIn('event_type_id', [$this->type_kejadian])->first()->event_type_id)) {
            $this->validate([
                'type_kejadian' => 'required',
                'jenis_kejadian' => 'required',
                'workgroup' => 'required',
                'report_by' => 'required',
                'report_to' => 'required',
                'tgl_kejadian' => 'required',
                'tgl_dilaporkan' => 'required',
                'waktu_kejadian' => 'required',
                'lokasi_kejadian' => 'required',
                'site_name' => 'required',
                'occupation' => 'required',
                'explanation' => 'required',
                'contract_area' => 'required',
                'actual_outcome' => 'required',
                'potential_consequence' => 'required',
                'potential_likelihood' => 'required',
            ]);
            $event_report = EventReport::create([
                'type_kejadian' => $this->type_kejadian,
                'jenis_kejadian' => $this->jenis_kejadian,
                'workgroup' => $this->workgroup_id,
                'report_by' => $this->report_by,
                'report_to' => $this->report_to,
                'tgl_kejadian' => date('Y-m-d', strtotime($this->tgl_kejadian)),
                'tgl_dilaporkan' => date('Y-m-d', strtotime($this->tgl_dilaporkan)),
                'waktu_kejadian' => $this->waktu_kejadian,
                'lokasi_kejadian' => $this->lokasi_kejadian,
                'site_name' => $this->site_name,
                'occupation' => $this->occupation,
                'explanation' => $this->explanation,
                'actual_outcome' => $this->actual_outcome,
                'contract_area' => $this->contract_area,
                'potential_consequence' => $this->potential_consequence,
                'potential_likelihood' => $this->potential_likelihood,
                'immediate' => $this->immediate,
            ]);
            $i = $event_report->id;
            $decoded_id = Hashids::encode($i);
            $workflow_template_id = WorkflowStep::where('eventTypeId', $this->type_kejadian)->orderBy('id', 'ASC')->first()->workflow_template;
            $description = WorkflowAdministration::with(['StatusCode', 'ResponsibleRole'])->where('workflow_template', $workflow_template_id)->first()->description;
            $b = WorkflowAdministration::with(['StatusCode', 'ResponsibleRole'])->where('description', $description)->first()->id;

            StatusEvent::create([
                'assignTo' => null,
                'also_assignTo' => null,
                'event_report_id' => $i,
                'event_status_id' => $b,
            ]);
            $this->statusER = $description;
            $network_username = People::whereIn('network_username', User::get('username'))->pluck('id')->toArray();
            $id_moderator = UserSecurity::whereIn('user_id', $network_username)->where('workflow', 'Moderator')->pluck('user_id')->toArray();
            $people = People::whereIn('id', $id_moderator)->pluck('network_username')->toArray();
            $url = "http://127.0.0.1:8000/eventReport/details/$decoded_id";
            $moderator = User::whereIn('username', $people)->get();
            foreach ($moderator as $key => $user) {

                Mail::to($user->email)->send(new CreateEventReport($user->name, $this->statusER, $url, $this->occupation));
            }
            $reportBy = People::where('id', $this->search_reportTo_id)->first()->network_username;
            $lookup_name = People::where('id', $this->search_reportTo_id)->first()->lookup_name;
            $email = User::where('username', $reportBy)->first()->email;

            if ($email != null) {
                Mail::to($email)->send(new ReportBy($lookup_name, $this->statusER, $url, $this->occupation));
            }
            $this->clearFields();
            $this->emit('AddEventReport');
            return redirect()->route('eventReportRegister', ['id' => $decoded_id]);

        } else {
            $this->validate([
                'type_kejadian' => 'required',
                'jenis_kejadian' => 'required',
                'workgroup' => 'required',
                'report_by' => 'required',
                'report_to' => 'required',
                'tgl_kejadian' => 'required',
                'tgl_dilaporkan' => 'required',
                'waktu_kejadian' => 'required',
                'lokasi_kejadian' => 'required',
                'site_name' => 'required',
                'occupation' => 'required',
                'explanation' => 'required',
                'contract_area' => 'required',
            ]);

            $event_report = EventReport::create([
                'type_kejadian' => $this->type_kejadian,
                'jenis_kejadian' => $this->jenis_kejadian,
                'workgroup' => $this->workgroup_id,
                'report_by' => $this->report_by,
                'report_to' => $this->report_to,
                'tgl_kejadian' => date('Y-m-d', strtotime($this->tgl_kejadian)),
                'tgl_dilaporkan' => date('Y-m-d', strtotime($this->tgl_dilaporkan)),
                'waktu_kejadian' => $this->waktu_kejadian,
                'lokasi_kejadian' => $this->lokasi_kejadian,
                'site_name' => $this->site_name,
                'occupation' => $this->occupation,
                'explanation' => $this->explanation,
                'actual_outcome' => null,
                'potential_consequence' => null,
                'potential_likelihood' => null,
                'contract_area' => $this->contract_area,
                'immediate' => $this->immediate,
            ]);
            $i = $event_report->id;
            $decoded_id = Hashids::encode($i);
            $workflow_template_id = WorkflowStep::where('eventTypeId', $this->type_kejadian)->orderBy('id', 'ASC')->first()->workflow_template;
            $description = WorkflowAdministration::with(['StatusCode', 'ResponsibleRole'])->where('workflow_template', $workflow_template_id)->first()->description;
            $b = WorkflowAdministration::with(['StatusCode', 'ResponsibleRole'])->where('description', $description)->first()->id;

            StatusEvent::create([
                'assignTo' => null,
                'also_assignTo' => null,
                'event_report_id' => $i,
                'event_status_id' => $b,

            ]);
            $this->statusER = $description;
            // $this->statusER = StatusEvent::where('event_report_id', $i)->where('event_status_id', $b)->first()->EventStatus->status_code;
            $network_username = People::whereIn('network_username', User::get('username'))->pluck('id')->toArray();
            $id_moderator = UserSecurity::whereIn('user_id', $network_username)->where('workflow', 'Moderator')->pluck('user_id')->toArray();
            $people = People::whereIn('id', $id_moderator)->pluck('network_username')->toArray();
            $url = "http://127.0.0.1:8000/eventReport/details/$decoded_id";
            $moderator = User::whereIn('username', $people)->get();
            foreach ($moderator as $key => $user) {

                Mail::to($user->email)->cc($user->email)->send(new CreateEventReport($user->name, $this->statusER, $url, $this->occupation));
            }
            $reportBy = People::where('id', $this->search_reportTo_id)->first()->network_username;
            $lookup_name = People::where('id', $this->search_reportTo_id)->first()->lookup_name;
            $email = User::where('username', $reportBy)->first()->email;

            if ($email != null) {
                Mail::to($email)->send(new ReportBy($lookup_name, $this->statusER, $url, $this->occupation));
            }
            $this->clearFields();
            $this->emit('AddEventReport');
            return redirect()->route('eventReportRegister', ['id' => $decoded_id]);
        }

    }

    public function clearFields()
    {
        $this->type_kejadian = '';
        $this->jenis_kejadian = '';
        $this->workgroup = '';
        $this->report_by = '';
        $this->report_to = '';
        $this->tgl_kejadian = '';
        $this->tgl_dilaporkan = '';
        $this->waktu_kejadian = '';
        $this->lokasi_kejadian = '';
        $this->site_name = '';
        $this->occupation = '';
        $this->explanation = '';
        $this->actual_outcome = '';
        $this->potential_consequence = '';
        $this->potential_likelihood = '';
        $this->contract_area = '';

    }
// FUNCTION BTN MODAL
    public function wgClick()
    {
        $this->openModalWG = 'modal-open';
    }
    public function wgClickClose()
    {
        $this->openModalWG = '';
        $this->clearSearchWg();
    }
    public function reportByClick()
    {
        $this->openModalreportBy = 'modal-open';
    }
    public function reportByClickClose()
    {
        $this->openModalreportBy = '';
        $this->clearSearchWg();
    }
    public function reportToClick()
    {
        $this->openModalreportTo = 'modal-open';
    }
    public function reportToClickClose()
    {
        $this->openModalreportTo = '';
        $this->clearSearchWg();
    }
    public function responsibleClick()
    {
        $this->openModalResponsibleCompany = 'modal-open';
    }
    public function responsibleClickClose()
    {
        $this->openModalResponsibleCompany = '';
    }
// FUNCTION BTN INITIAL RISK
    public function btn_a1()
    {
        $this->potential_consequence = 6;
        $this->potential_likelihood = 1;
        $assessment = RiskAssessment::whereId(1)->first();
        $this->name_assessment = $assessment->name;
        $this->notes_assessment = $assessment->notes;
        $this->investigation_req_assessment = $assessment->investigation_req;
        $this->reporting_obligation_assessment = $assessment->reporting_obligation;
    }
    public function btn_a2()
    {
        $this->potential_consequence = 5;
        $this->potential_likelihood = 1;
        $assessment = RiskAssessment::whereId(1)->first();
        $this->name_assessment = $assessment->name;
        $this->notes_assessment = $assessment->notes;
        $this->investigation_req_assessment = $assessment->investigation_req;
        $this->reporting_obligation_assessment = $assessment->reporting_obligation;
    }
    public function btn_a3()
    {
        $this->potential_consequence = 4;
        $this->potential_likelihood = 1;
        $assessment = RiskAssessment::whereId(1)->first();
        $this->name_assessment = $assessment->name;
        $this->notes_assessment = $assessment->notes;
        $this->investigation_req_assessment = $assessment->investigation_req;
        $this->reporting_obligation_assessment = $assessment->reporting_obligation;
    }
    public function btn_a4()
    {
        $this->potential_consequence = 3;
        $this->potential_likelihood = 1;
        $assessment = RiskAssessment::whereId(2)->first();
        $this->name_assessment = $assessment->name;
        $this->notes_assessment = $assessment->notes;
        $this->investigation_req_assessment = $assessment->investigation_req;
        $this->reporting_obligation_assessment = $assessment->reporting_obligation;
    }
    public function btn_a5()
    {
        $this->potential_consequence = 2;
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
        $this->potential_consequence = 6;
        $this->potential_likelihood = 2;
        $assessment = RiskAssessment::whereId(1)->first();
        $this->name_assessment = $assessment->name;
        $this->notes_assessment = $assessment->notes;
        $this->investigation_req_assessment = $assessment->investigation_req;
        $this->reporting_obligation_assessment = $assessment->reporting_obligation;
    }
    public function btn_b2()
    {
        $this->potential_consequence = 5;
        $this->potential_likelihood = 2;
        $assessment = RiskAssessment::whereId(1)->first();
        $this->name_assessment = $assessment->name;
        $this->notes_assessment = $assessment->notes;
        $this->investigation_req_assessment = $assessment->investigation_req;
        $this->reporting_obligation_assessment = $assessment->reporting_obligation;
    }
    public function btn_b3()
    {
        $this->potential_consequence = 4;
        $this->potential_likelihood = 2;
        $assessment = RiskAssessment::whereId(2)->first();
        $this->name_assessment = $assessment->name;
        $this->notes_assessment = $assessment->notes;
        $this->investigation_req_assessment = $assessment->investigation_req;
        $this->reporting_obligation_assessment = $assessment->reporting_obligation;
    }
    public function btn_b4()
    {
        $this->potential_consequence = 3;
        $this->potential_likelihood = 2;
        $assessment = RiskAssessment::whereId(2)->first();
        $this->name_assessment = $assessment->name;
        $this->notes_assessment = $assessment->notes;
        $this->investigation_req_assessment = $assessment->investigation_req;
        $this->reporting_obligation_assessment = $assessment->reporting_obligation;
    }
    public function btn_b5()
    {
        $this->potential_consequence = 2;
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
        $this->potential_consequence = 6;
        $this->potential_likelihood = 3;

        $assessment = RiskAssessment::whereId(1)->first();
        $this->name_assessment = $assessment->name;
        $this->notes_assessment = $assessment->notes;
        $this->investigation_req_assessment = $assessment->investigation_req;
        $this->reporting_obligation_assessment = $assessment->reporting_obligation;
    }
    public function btn_c2()
    {
        $this->potential_consequence = 5;
        $this->potential_likelihood = 3;

        $assessment = RiskAssessment::whereId(1)->first();
        $this->name_assessment = $assessment->name;
        $this->notes_assessment = $assessment->notes;
        $this->investigation_req_assessment = $assessment->investigation_req;
        $this->reporting_obligation_assessment = $assessment->reporting_obligation;
    }
    public function btn_c3()
    {
        $this->potential_consequence = 4;
        $this->potential_likelihood = 3;
        $assessment = RiskAssessment::whereId(2)->first();
        $this->name_assessment = $assessment->name;
        $this->notes_assessment = $assessment->notes;
        $this->investigation_req_assessment = $assessment->investigation_req;
        $this->reporting_obligation_assessment = $assessment->reporting_obligation;
    }
    public function btn_c4()
    {
        $this->potential_consequence = 3;
        $this->potential_likelihood = 3;
        $assessment = RiskAssessment::whereId(3)->first();
        $this->name_assessment = $assessment->name;
        $this->notes_assessment = $assessment->notes;
        $this->investigation_req_assessment = $assessment->investigation_req;
        $this->reporting_obligation_assessment = $assessment->reporting_obligation;
    }
    public function btn_c5()
    {
        $this->potential_consequence = 2;
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
        $this->potential_consequence = 6;
        $this->potential_likelihood = 4;
        $assessment = RiskAssessment::whereId(1)->first();
        $this->name_assessment = $assessment->name;
        $this->notes_assessment = $assessment->notes;
        $this->investigation_req_assessment = $assessment->investigation_req;
        $this->reporting_obligation_assessment = $assessment->reporting_obligation;
    }
    public function btn_d2()
    {
        $this->potential_consequence = 5;
        $this->potential_likelihood = 4;
        $assessment = RiskAssessment::whereId(2)->first();
        $this->name_assessment = $assessment->name;
        $this->notes_assessment = $assessment->notes;
        $this->investigation_req_assessment = $assessment->investigation_req;
        $this->reporting_obligation_assessment = $assessment->reporting_obligation;
    }
    public function btn_d3()
    {
        $this->potential_consequence = 4;
        $this->potential_likelihood = 4;
        $assessment = RiskAssessment::whereId(3)->first();
        $this->name_assessment = $assessment->name;
        $this->notes_assessment = $assessment->notes;
        $this->investigation_req_assessment = $assessment->investigation_req;
        $this->reporting_obligation_assessment = $assessment->reporting_obligation;
    }
    public function btn_d4()
    {
        $this->potential_consequence = 3;
        $this->potential_likelihood = 4;
        $assessment = RiskAssessment::whereId(4)->first();
        $this->name_assessment = $assessment->name;
        $this->notes_assessment = $assessment->notes;
        $this->investigation_req_assessment = $assessment->investigation_req;
        $this->reporting_obligation_assessment = $assessment->reporting_obligation;
    }
    public function btn_d5()
    {
        $this->potential_consequence = 2;
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
        $this->potential_consequence = 6;
        $this->potential_likelihood = 6;
        $assessment = RiskAssessment::whereId(2)->first();
        $this->name_assessment = $assessment->name;
        $this->notes_assessment = $assessment->notes;
        $this->investigation_req_assessment = $assessment->investigation_req;
        $this->reporting_obligation_assessment = $assessment->reporting_obligation;
    }
    public function btn_e2()
    {
        $this->potential_consequence = 5;
        $this->potential_likelihood = 6;
        $assessment = RiskAssessment::whereId(2)->first();
        $this->name_assessment = $assessment->name;
        $this->notes_assessment = $assessment->notes;
        $this->investigation_req_assessment = $assessment->investigation_req;
        $this->reporting_obligation_assessment = $assessment->reporting_obligation;
    }
    public function btn_e3()
    {
        $this->potential_consequence = 4;
        $this->potential_likelihood = 6;
        $assessment = RiskAssessment::whereId(3)->first();
        $this->name_assessment = $assessment->name;
        $this->notes_assessment = $assessment->notes;
        $this->investigation_req_assessment = $assessment->investigation_req;
        $this->reporting_obligation_assessment = $assessment->reporting_obligation;
    }
    public function btn_e4()
    {
        $this->potential_consequence = 3;
        $this->potential_likelihood = 6;
        $assessment = RiskAssessment::whereId(4)->first();
        $this->name_assessment = $assessment->name;
        $this->notes_assessment = $assessment->notes;
        $this->investigation_req_assessment = $assessment->investigation_req;
        $this->reporting_obligation_assessment = $assessment->reporting_obligation;
    }
    public function btn_e5()
    {
        $this->potential_consequence = 2;
        $this->potential_likelihood = 6;
        $assessment = RiskAssessment::whereId(4)->first();
        $this->name_assessment = $assessment->name;
        $this->notes_assessment = $assessment->notes;
        $this->investigation_req_assessment = $assessment->investigation_req;
        $this->reporting_obligation_assessment = $assessment->reporting_obligation;
    }

}
