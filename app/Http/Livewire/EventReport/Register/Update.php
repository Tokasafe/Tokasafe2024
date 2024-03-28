<?php

namespace App\Http\Livewire\EventReport\Register;

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
use App\Models\Workgroup;
use Livewire\Component;
use Vinkla\Hashids\Facades\Hashids;

class Update extends Component
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
    public $occupation;
    public $explanation;
    public $actual_outcome;
    public $potential_consequence;
    public $potential_likelihood;
    public $contract_area;
    public $moderateBy;
    public $immediate;
    public $status;
    public $ID_Details;

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
    public $real_id;
    public $radio_select;
    public $search_workgroup = '';
    public $search_company = '';
    public $search_reportBy = '';
    public $search_reportTo = '';
    public $showWG = true;
    public $showAccess = false;

    public function mount($id)
    {
        $this->real_id = $id;
        $decoded_id = Hashids::decode($id);
        $this->ID_Details = $decoded_id[0];
        $ER = EventReport::whereid($decoded_id)->first();
        $Bu = $ER->Workgroup->CompanyLevel->BussinessUnit->name;
        $deptORcont = $ER->Workgroup->CompanyLevel->deptORcont;
        $job_class = $ER->Workgroup->job_class;
        $this->workgroup = "$Bu-$deptORcont-$job_class";
        $this->workgroup_id = $ER->workgroup;
        $this->type_kejadian = $ER->type_kejadian;
        $this->jenis_kejadian = $ER->jenis_kejadian;
        $this->report_by = $ER->report_by;
        $this->report_to = $ER->report_to;
        $this->tgl_kejadian = date('d-m-Y', strtotime($ER->tgl_kejadian));
        $this->tgl_dilaporkan = date('d-m-Y', strtotime($ER->tgl_dilaporkan));
        $this->waktu_kejadian = $ER->waktu_kejadian;
        $this->lokasi_kejadian = $ER->lokasi_kejadian;
        $this->site_name = $ER->site_name;
        $this->occupation = $ER->occupation;
        $this->explanation = $ER->explanation;
        $this->actual_outcome = $ER->actual_outcome;
        $this->potential_consequence = $ER->potential_consequence;
        $this->potential_likelihood = $ER->potential_likelihood;
        $this->contract_area = $ER->contract_area;
        $this->immediate = $ER->immediate;
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

        if (!empty($this->type_kejadian)) {
            $this->SubType = EventSubType::where('eventType_id', $this->type_kejadian)->get();
            if (!empty(AccessRiskAssessment::with('EventType')->whereIn('event_type_id', [$this->type_kejadian])->first()->event_type_id)) {
                $this->showAccess = true;
            } else {
                $this->showAccess = false;
            }
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

        return view('livewire.event-report.register.update', [
            'Eventype' => EventType::with(['EventCategory'])->orderBy('eventCategory_id', 'ASC')->get(),
            'Consequence' => RiskConsequence::get(),
            'Likelihood' => RiskLikelihood::get(),
            'People' => People::with('Employer')->search(trim($this->search_reportBy))->searchto(trim($this->search_reportTo))->get(),
            'LocationEvent' => EventLocation::get(),
            'EventSite' => EventSite::get(),
            'Company' => Companies::with(['CompanyCategory'])->searchcompany(trim($this->search_company))->get(),
        ])->extends('livewire.event-report.details')->section('eventDetails');
    }

    public function store()
    {
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
            'actual_outcome' => 'required',
            'potential_consequence' => 'required',
            'potential_likelihood' => 'required',
            'contract_area' => 'required',
        ]);

        try {
            EventReport::whereId($this->ID_Details)->update([
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
                'potential_consequence' => $this->potential_consequence,
                'potential_likelihood' => $this->potential_likelihood,
                'contract_area' => $this->contract_area,
                'immediate' => $this->immediate,
            ]);
            session()->flash('success', 'Data Updated Successfully!!');
        } catch (\Exception $ex) {
            session()->flash('success', 'Something goes wrong!!');
        }
    }

    // ClickFunction
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
    public function cari_reportBy($id)
    {

        if (!empty($id)) {
            $reportBy = People::whereId($id)->first();
            $this->report_by = $reportBy->lookup_name;
            $this->reportByClickClose();
        }
    }
    public function cari_reportTo($id)
    {

        if (!empty($id)) {
            $reportTo = People::whereId($id)->first();
            $this->report_to = $reportTo->lookup_name;
            $this->reportToClickClose();
        }
    }

    public function workGroup($id, $bu, $deptOrCont, $job_class)
    {
        $this->workgroup_id = $id;
        $this->workgroup = "$bu-$deptOrCont-$job_class";
        $this->wgClickClose();
    }
    public function clearSearchWg()
    {

        $this->search_workgroup = '';
        $this->radio_select = '';
        $this->search_reportBy = '';
        $this->search_reportTo = '';
        $this->search_company = '';
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
