<?php

namespace App\Http\Livewire\EventReportList\HazardId;

use App\Models\People;
use Livewire\Component;
use App\Models\HazardId;
use App\Models\Companies;
use App\Models\EventType;
use App\Models\Workgroup;
use App\Models\CompanyLevel;
use App\Models\EventSubType;
use App\Models\EventLocation;
use App\Models\PanelHazardId;
use App\Models\RiskAssessment;
use App\Models\RiskLikelihood;
use App\Models\RiskConsequence;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class Details extends Component
{
    use WithFileUploads;
    use WithPagination;
    public $reference;
    public $tanggal;
    public $workgroup;
    public $workgroup_id;
    public $radio_select;
    public $waktu;
    public $lokasi;
    public $search_reportTo='';
    public $pengawas_area;
    public $pengawas_area_id;
    public $nama_pelapor;
    public $nama_pelapor_id;
    public $event_subtype;
    public $documentation;
    public $documentation1;
    public $tanggal_kejadian;
    public $search_reportBy = '';
    public $search_workgroup = '';
    public $search_company = '';
    public $openModalWG = '';
    public $openModalreportBy = '';
    public $openModalreportTo = '';
    public $openModalResponsibleCompany = '';
    public $CompanyLevel = [];
    public $ModalWorkgroup = [];
    public $name_assessment;
    public $potential_consequence;
    public $potential_likelihood;
    public $notes_assessment;
    public $rincian_bahaya;
    public $tindakan_perbaikan;
    public $tindakan_perbaikan_disarankan;
    public $actual_outcome;
    public $tindakan_perbaikan_dilakuan;
    public $komentar;
    public $investigation_req_assessment;
    public $reporting_obligation_assessment;
    public $actual_outcome_description = '';
    public $potential_consequence_description = '';
    public $potential_likelihood_description = '';
    public $showWG = true;
    public $showAccess = false;
    public $data_id;
    public $hazardClose;
    public function mount($id)
    {
        $model = HazardId::find($id);
        if ($model === null) {
           abort(404);
        }

        $HazardId = HazardId::whereId($id)->first();
        $a = $HazardId->Workgroup->CompanyLevel->BussinessUnit->name;
        $b = $HazardId->Workgroup->CompanyLevel->deptORcont;
        $c = $HazardId->Workgroup->job_class;

        $this->data_id = $HazardId->id;
        $close = PanelHazardId::where('hazard_id',$this->data_id)->first()->WorkflowStep->name;
        if ($close ==='Closed' || $close ==='Cancelled') {
            $this->hazardClose = $close;
            
        }
        $this->event_subtype = $HazardId->event_subtype;
        $this->nama_pelapor = $HazardId->People->lookup_name;
        $this->nama_pelapor_id = $HazardId->nama_pelapor;
        $this->tanggal_kejadian = date('d-m-Y', strtotime($HazardId->tanggal_kejadian));
        $this->waktu = $HazardId->waktu;
        $this->workgroup = "$a-$b-$c";
        $this->pengawas_area = $HazardId->Pengawas->lookup_name;
        $this->pengawas_area_id = $HazardId->pengawas_area;
        $this->lokasi = $HazardId->lokasi;
        $this->workgroup_id = $HazardId->workgroup;
        $this->documentation = $HazardId->documentation;
        $this->rincian_bahaya = $HazardId->rincian_bahaya;
        $this->tindakan_perbaikan = $HazardId->tindakan_perbaikan;
        $this->tindakan_perbaikan_disarankan = $HazardId->tindakan_perbaikan_disarankan;
        $this->actual_outcome = $HazardId->actual_outcome;
        $this->potential_consequence = $HazardId->potential_consequence;
        $this->potential_likelihood = $HazardId->potential_likelihood;
        $this->tindakan_perbaikan_dilakuan = $HazardId->tindakan_perbaikan_dilakuan;
        $this->komentar = $HazardId->komentar;
        $this->reference = $HazardId->reference;
        //    dd($this->pengawas_area_id);
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
        return view('livewire.event-report-list.hazard-id.detail', [
            'LocationEvent' => EventLocation::get(),
            'EventType' => EventType::get(),
            'EventSubType' => EventSubType::with('EventType')->where('eventType_id', 1)->get(),
            'People' => People::with('Employer')->search(trim($this->search_reportBy))->paginate(10),
            'Supervisor' => People::with('Employer')->searchto(trim($this->search_reportTo))->paginate(10),
            'Company' => Companies::with(['CompanyCategory'])->searchcompany(trim($this->search_company))->get(),
            'Consequence' => RiskConsequence::get(),
            'Likelihood' => RiskLikelihood::get(),
        ])->extends('navigation.homebase', ['header' => 'Hazard report', 'title' => 'hazard', 'h1' => $this->data_id])->section('content');
    } // FUNCTION BTN MODAL
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
            $this->nama_pelapor = $reportBy->lookup_name;
            $this->nama_pelapor_id = $reportBy->id;
            $this->reportByClickClose();
        }
    }
    public function cari_reportTo($id)
    {

        if (!empty($id)) {
            $reportTo = People::with('Employer')->whereId($id)->first();
            $this->pengawas_area = $reportTo->lookup_name;
            $this->pengawas_area_id = $reportTo->id;

            $this->reportToClickClose();
        }
    }
    public function download($id)
    {
        $name = HazardId::whereId($id)->first()->documentation;
        return response()->download(storage_path('app/public/documents/' . $name));
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
       
        if (empty($this->documentation1)) {
            $file_name = $this->documentation;
          
        } else {

            $file_name = $this->documentation1->getClientOriginalName();
            $this->documentation1->storeAs('public/documents', $file_name);
            
        }

        $this->validate([
            'nama_pelapor' => 'required',
            'event_subtype' => 'required',
            'tanggal_kejadian' => 'required',
            'waktu' => 'required',
            'workgroup' => 'required',
            'pengawas_area' => 'required',
            'lokasi' => 'required',
            'rincian_bahaya' => 'required',
            'tindakan_perbaikan' => 'required',
            'tindakan_perbaikan_disarankan' => 'required',
            'actual_outcome' => 'required',
            'potential_consequence' => 'required',
            'potential_likelihood' => 'required',
            // 'tindakan_perbaikan_dilakuan' => 'required',

        ]);
        try {
            HazardId::whereId($this->data_id)->update([
                'nama_pelapor' => $this->nama_pelapor_id,
                'event_subtype' => $this->event_subtype,
                'tanggal_kejadian' => date('Y-m-d', strtotime($this->tanggal_kejadian)),
                'waktu' => $this->waktu,
                'workgroup' => $this->workgroup_id,
                'pengawas_area' => $this->pengawas_area_id,
                'lokasi' => $this->lokasi,
                'rincian_bahaya' => $this->rincian_bahaya,
                'tindakan_perbaikan' => $this->tindakan_perbaikan,
                'tindakan_perbaikan_disarankan' => $this->tindakan_perbaikan_disarankan,
                'documentation' => $file_name,
                'komentar' => $this->komentar,
                'actual_outcome' => $this->actual_outcome,
                'potential_consequence' => $this->potential_consequence,
                'potential_likelihood' => $this->potential_likelihood,
                // 'tindakan_perbaikan_dilakuan' => $this->tindakan_perbaikan_dilakuan,
            ]);
           
            
            return redirect()->route('hazardDetails', ['id' => $this->data_id]);
        } catch (\Exception $ex) {
            session()->flash('success', 'Something goes wrong!!');
        }
    }
    public function deleted()
    {
        try {
            HazardId::find($this->data_id)->delete();
            unlink(storage_path('app/public/documents/' . $this->documentation));
            return redirect()->route('hazard');
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
