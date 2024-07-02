<?php

namespace App\Http\Livewire\EventReportList\HazardId;

use Carbon\Carbon;
use App\Models\User;
use App\Models\People;
use Livewire\Component;
use App\Models\HazardId;
use App\Models\Companies;
use App\Models\EventType;
use App\Models\Workgroup;
use App\Models\CompanyLevel;
use App\Models\EventSubType;
use App\Models\UserSecurity;
use App\Models\WorkflowStep;
use Livewire\WithPagination;
use App\Models\EventLocation;
use App\Models\PanelHazardId;
use Livewire\WithFileUploads;
use App\Models\RiskAssessment;
use App\Models\RiskLikelihood;
use App\Models\RiskConsequence;
use App\Notifications\ToModerator;
use App\Notifications\ToSupervisor;
use App\Models\WorkflowAdministration;
use Illuminate\Support\Facades\Notification;

class Create extends Component
{
    use WithFileUploads;
    use WithPagination;
    public $search_reportBy = '';
    public $actual_outcome;
    public $search_company = '';
    public $actual_outcome_description = '';
    public $potential_consequence_description = '';
    public $potential_likelihood_description = '';
    public $potential_consequence;
    public $potential_likelihood;
    public $name_assessment;
    public $notes_assessment;
    public $investigation_req_assessment;
    public $reporting_obligation_assessment;
    public $workgroup_id;
    public $workgroup;
    public $tanggal_kejadian;
    public $waktu, $hazardClose;
    public $lokasi;
    public $eventType_id;
    public $reference = '';
    public $search_reportTo_id;
    public $documentation;
    public $rincian_bahaya;
    public $tindakan_perbaikan;
    public $tindakan_perbaikan_disarankan;
    public $pengawas_area;
    public $pengawas_area_id;
    public $nama_pelapor_id;
    public $event_subtype;
    public $nama_pelapor;
    public $task;
    public $fileUpload;
    public $statusER;
    public $id_hazard;
    public $id_hazardBack;
    public $modal = '';
    public $tab='checked';
    public $tab2;
    public $EventSubType = [];
    public $openModalWG = "modal";
    public $openModalreportBy = '';
    public $openModalreportTo = '';
    public $search_reportTo = '';
    public $search = '';
    public $search_workgroup = '';
    public $search_companyLevel = '';
    public $radio_select = '';
    public $openModalResponsibleCompany = '';
    public $ModalWorkgroup = [];
    public $showWG = true;
    public $showDataInput = false;
    public $showAccess = false;
    public $wg_id;
    public $filename;
    public $show_reportBy = 'hidden';
    public $show_reportTo = 'hidden';
    public function clearSearchWg()
    {
        $this->search_workgroup = '';
        $this->radio_select = '';
        $this->search_reportBy = '';
        $this->search_reportTo = '';
        $this->search_company = '';
    }
    protected $listeners = [
        'OpenModalHzd',
        'backTabFunction'
    ];

    public function backTabFunction($value)
    {
        if ($value) {
            $this->tab='checked';
            $this->id_hazardBack = $value;
            $HazardId = HazardId::with(['Workgroup.CompanyLevel', 'Workgroup.CompanyLevel.BussinessUnit'])->whereId($this->id_hazardBack)->first();
            
            if ( $HazardId) {
                $a = $HazardId->Workgroup->CompanyLevel->BussinessUnit->name;
                $b = $HazardId->Workgroup->CompanyLevel->deptORcont;
                $c = $HazardId->Workgroup->job_class;
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
                $this->filename = $HazardId->documentation;
                $this->rincian_bahaya = $HazardId->rincian_bahaya;
                $this->tindakan_perbaikan = $HazardId->tindakan_perbaikan;
                $this->tindakan_perbaikan_disarankan = $HazardId->tindakan_perbaikan_disarankan;
                $this->actual_outcome = $HazardId->actual_outcome;
                $this->potential_consequence = $HazardId->potential_consequence;
                $this->potential_likelihood = $HazardId->potential_likelihood;
                // $this->tindakan_perbaikan_dilakuan = $HazardId->tindakan_perbaikan_dilakuan;
                // $this->komentar = $HazardId->komentar;
                $this->task = $HazardId->task;
                $this->reference = $HazardId->reference;
            }
        }
       
        
        $this->tab2 = '';
    }
    public function OpenModalHzd($value)
    {
        $this->modal = $value;
    }
    public function render()
    {
    
        $this->modal;
        $this->click();
        $this->showReportTo();
        $this->showReportBy();
        $this->radioSelect();
        $this->riskAssessment();
        if (!empty($this->documentation)) {
            $file_name = $this->documentation->getClientOriginalName();
            $this->fileUpload  = pathinfo($file_name, PATHINFO_EXTENSION);
            $this->filename = null;
        }
        $this->ModalWorkgroup = (!empty($this->wg_id)) ? Workgroup::with(['CompanyLevel', 'CompanyLevel.BussinessUnit'])->searchWG(trim($this->search_workgroup))->searchWgId(trim($this->wg_id))->orderBy('companyLevel_id', 'asc')->get() : Workgroup::with(['CompanyLevel', 'CompanyLevel.BussinessUnit'])->searchWG(trim($this->search_workgroup))->orderBy('companyLevel_id', 'asc')->get();
        $this->EventSubType = EventSubType::with('EventType')->where('eventType_id', 1)->get();
       
        return view('livewire.event-report-list.hazard-id.create', [
            'LocationEvent' => EventLocation::get(),
            'EventType' => EventType::get(),
            'People' => People::with('Employer')->search(trim($this->nama_pelapor))->paginate(100, ['*'], 'ReportByPage'),
            'Supervisor' => People::with('Employer')->search(trim($this->pengawas_area))->paginate(100, ['*'], 'ReportToPage'),
            'CompanyLevel' => CompanyLevel::with(['BussinessUnit'])->deptcont(trim($this->search_companyLevel))->orderBy('bussiness_unit', 'asc')->get(),
            'Company' => Companies::with(['CompanyCategory'])->searchcompany(trim($this->search_company))->get(),
            'Consequence' => RiskConsequence::get(),
            'Likelihood' => RiskLikelihood::get(),
        ]);
    }
    public function riskAssessment(){
        $this->actual_outcome_description  = (!empty($this->actual_outcome)) ? RiskConsequence::whereId($this->actual_outcome)->first()->description : $this->actual_outcome_description = '';
        $this->potential_consequence_description  = (!empty($this->potential_consequence)) ? RiskConsequence::whereId($this->potential_consequence)->first()->description : $this->potential_consequence_description = '';
        $this->potential_likelihood_description  = (!empty($this->potential_likelihood)) ? RiskLikelihood::whereId($this->potential_likelihood)->first()->notes : $this->potential_likelihood_description = '';
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
    public function store()
    {
        if (!$this->documentation) {
            $file_name = $this->filename;
        } else {

            $file_name = $this->documentation->getClientOriginalName();
            $this->documentation->storeAs('public/documents', $file_name);
        }
        $a = $this->generateUniqueCode();
        $this->reference = "hzd-$a";
        $this->validate([
            'nama_pelapor' => 'required',
            'event_subtype' => 'required',
            'tanggal_kejadian' => 'required',
            'waktu' => 'required',
            'workgroup' => 'required',
            'pengawas_area' => 'required',
            'lokasi' => 'required',
            'rincian_bahaya' => 'required',
            'tindakan_perbaikan' => 'nullable',
            'tindakan_perbaikan_disarankan' => 'nullable',
            'actual_outcome' => 'required',
            'potential_consequence' => 'required',
            'potential_likelihood' => 'required',
            'task' => 'required',

            'documentation' => 'nullable|mimes:jpg,jpeg,png,svg,gif,xlsx,pdf,docx',
        ]);

        try {
        $hazard_ids =  HazardId::updateOrCreate(['id'=>$this->id_hazardBack],[
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
            'reference' => $this->reference,
            'actual_outcome' => $this->actual_outcome,
            'potential_consequence' => $this->potential_consequence,
            'potential_likelihood' => $this->potential_likelihood,
            'task' => $this->task,
            'documentation' => $file_name
        ]);
        $this->clearFields();
        $this->id_hazard = $hazard_ids->id;
        $this->tab ='';
        $this->tab2 ='checked';
        $this->emit('pasing_id',$this->id_hazard);
 
        } catch (\Throwable $th) {
            session()->flash('success', 'Something goes wrong!!');
        }
    }
    public function wgClick()
    {
        $this->openModalWG = "modal modal-open";
    }
    public function wgClickClose()
    {
        $this->openModalWG = 'modal';
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
        if ($id) {
            $this->wg_id = $id;
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
        }
    }
    public function showReportBy()
    {
        if (empty($this->nama_pelapor)) {
            $this->show_reportBy = 'hidden';
            $this->reset('nama_pelapor_id');
        } elseif (!People::where('lookup_name', $this->nama_pelapor)->first()) {
            $this->show_reportBy = 'block';
        } else {
            $this->show_reportBy = 'hidden';
        }
    }
    public function cari_reportTo($id)
    {

        if (!empty($id)) {
            $reportTo = People::with('Employer')->whereId($id)->first();
            $this->pengawas_area = $reportTo->lookup_name;
            $this->pengawas_area_id = $reportTo->id;
        }
    }
    public function showReportTo()
    {
        if (empty($this->pengawas_area)) {
            $this->show_reportTo = 'hidden';
            $this->reset('pengawas_area_id');
        } elseif (!People::cari(trim($this->pengawas_area))->first()) {
            $this->show_reportTo = 'block';
        } else {
            $this->show_reportTo = 'hidden';
        }
    }
    public function openModal()
    {
        $this->modal = 'modal-open';
    }
    public function closeModal()
    {
        
       if ($this->id_hazardBack) {
       
           
            HazardId::whereId($this->id_hazardBack)->delete();
            if ($this->documentation) {
                unlink(storage_path('app/public/documents/' . $this->documentation));
            }
      
       }
       $this->modal = '';
    }

    public function clearFields()
    {
        $this->nama_pelapor = '';
        $this->pengawas_area = '';
        $this->event_subtype = '';
        $this->waktu = '';
        $this->tanggal_kejadian = '';
        $this->workgroup = '';
        $this->lokasi = '';
        $this->documentation = '';
        $this->rincian_bahaya = '';
        $this->tindakan_perbaikan = '';
        $this->tindakan_perbaikan_disarankan = '';
        $this->task = '';
        $this->rincian_bahaya = '';
        $this->potential_likelihood = '';
        $this->actual_outcome = '';
        $this->potential_consequence = '';
    }
    public function generateUniqueCode()
    {
        do {
            $code = (string) random_int(100000, 999999);
        } while (HazardId::where('reference', '=', $code)->first());

        return $code;
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
