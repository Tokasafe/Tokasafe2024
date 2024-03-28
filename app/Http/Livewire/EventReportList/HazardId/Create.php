<?php

namespace App\Http\Livewire\EventReportList\HazardId;

use App\Models\User;
use App\Mail\ReportBy;
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
use App\Mail\CreateEventReport;
use App\Models\RiskConsequence;
use App\Notifications\ToModerator;
use App\Notifications\ToSupervisor;
use Illuminate\Support\Facades\Mail;
use App\Models\WorkflowAdministration;
use App\Notifications\NewSendToModerator;
use App\Notifications\NewUserNotification;
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
    public $statusER;
    public $modal = '';

    public $CompanyLevel = [];
    public $EventSubType = [];
    public $openModalWG = '';
    public $openModalreportBy = '';
    public $openModalreportTo = '';
    public $search_reportTo = '';
    public $search_workgroup = '';
    public $radio_select = '';
    public $openModalResponsibleCompany = '';
    public $ModalWorkgroup = [];
    public $showWG = true;
    public $showDataInput = false;
    public $showAccess = false;
    public function clearSearchWg()
    {
        $this->search_workgroup = '';
        $this->radio_select = '';
        $this->search_reportBy = '';
        $this->search_reportTo = '';
        $this->search_company = '';
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

        if (empty($this->nama_pelapor)) {
            if (!empty(auth()->user()->username)) {
                if (!empty(People::where('network_username', auth()->user()->username)->first()->lookup_name)) {
                    # code...
                    $this->nama_pelapor = People::where('network_username', auth()->user()->username)->first()->lookup_name;
                    $this->nama_pelapor_id = People::where('network_username', auth()->user()->username)->first()->id;
                }
            } else {
                $this->nama_pelapor = '';
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
        $this->EventSubType = EventSubType::with('EventType')->where('eventType_id', 1)->get();
        return view('livewire.event-report-list.hazard-id.create', [
            'LocationEvent' => EventLocation::get(),
            'EventType' => EventType::get(),
            'People' => People::with('Employer')->search(trim($this->search_reportBy))->paginate(10),
            'Supervisor' => People::with('Employer')->searchto(trim($this->search_reportTo))->paginate(10),
            'Company' => Companies::with(['CompanyCategory'])->searchcompany(trim($this->search_company))->get(),
            'Consequence' => RiskConsequence::get(),
            'Likelihood' => RiskLikelihood::get(),
        ]);
    }
    public function paginationView()
    {
        return 'livewire.pagination';
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
    public function openModal()
    {
        $this->modal = 'modal-open';
    }
    public function closeModal()
    {
        $this->modal = '';
    }
    public function store()
    {

        if (!empty($this->documentation)) {
            $file_name = $this->documentation->getClientOriginalName();
            $this->documentation->storeAs('public/documents', $file_name);
        } else {
            $file_name = "";
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
            'tindakan_perbaikan' => 'required',
            'tindakan_perbaikan_disarankan' => 'required',
            'actual_outcome' => 'required',
            'potential_consequence' => 'required',
            'potential_likelihood' => 'required',

            'documentation' => 'nullable|mimes:jpg,jpeg,png,svg,gif,xlsx,pdf,docx',
        ]);

        try {
            $hazard_ids =  HazardId::create([
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
                'documentation' => $file_name
            ]);

            $workflow_template_id = WorkflowStep::where('eventTypeId', 1)->orderBy('id', 'ASC')->first()->workflow_template;
            $description = WorkflowAdministration::with(['StatusCode', 'ResponsibleRole'])->where('workflow_template', $workflow_template_id)->first()->description;
            $b = WorkflowAdministration::with(['StatusCode', 'ResponsibleRole'])->where('description', $description)->first()->id;
            PanelHazardId::create([
                'assignTo' => null,
                'also_assignTo' => null,
                'hazard_id' => $hazard_ids->id,
                'workflow_step' => $b,

            ]);
            $idhazard = $hazard_ids->id;
            $url = "$idhazard";
            $this->statusER = $description;
            $network_username = People::whereIn('network_username', User::get('username'))->pluck('id')->toArray();
            $id_moderator = UserSecurity::whereIn('user_id', $network_username)->where('user_id', 'NOT LIKE', auth()->user()->id)->where('event_sub_types_id',$this->event_subtype)->where('workflow', 'Moderator')->pluck('user_id')->toArray();
            $nameSubType = EventSubType::whereId($this->event_subtype)->first()->EventType->name;

            $people = People::whereIn('id', $id_moderator)->pluck('network_username')->toArray();
            $moderator = User::whereIn('username', $people)->get();
            $reportTo = People::where('id', $this->pengawas_area_id)->first()->network_username;
        
            if ($reportTo) {
                $pengawas = User::where('username', $reportTo)->get();
                
                $offerDataSpv = [
                    'name' =>'Report By' . ' ' . $this->nama_pelapor,
                    'subject' => $nameSubType,
                    'body' => $this->rincian_bahaya,
                    'thanks' => 'Thank you',
                    'offerText' => $this->reference,
                    'offerUrl' => url("http://tokasafe.tokatindung.com/eventReport/hazard_id/$url"),
                    'offer_id' => $url
                ];

                Notification::send($pengawas, new ToSupervisor($offerDataSpv));
            }
            $offerData = [
                'name' =>'Report By' . ' ' . $this->nama_pelapor,
                'subject' => $nameSubType,
                'body' => $this->rincian_bahaya,
                'thanks' => 'Thank you',
                'offerText' => $this->reference,
                'offerUrl' => url("http://tokasafe.tokatindung.com/eventReport/hazard_id/$url"),
                'offer_id' => $url
            ];
            Notification::send($moderator, new ToModerator($offerData));
            $this->emit('hazard_add');
            $this->closeModal();
            $this->clearFields();
            if (auth()->user()->role_users_id == 2) {
                return redirect()->route('hazardDetailsGuest', ['id' =>  $idhazard]);
            } else {

                return redirect()->route('hazardDetails', ['id' =>  $idhazard]);
            }
        } catch (\Throwable $th) {
            session()->flash('success', 'Something goes wrong!!');
        }
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
