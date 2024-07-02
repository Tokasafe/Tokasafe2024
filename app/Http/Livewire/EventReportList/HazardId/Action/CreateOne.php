<?php

namespace App\Http\Livewire\EventReportList\HazardId\Action;


use Carbon\Carbon;
use App\Models\User;
use App\Models\People;
use Livewire\Component;
use App\Models\HazardId;
use App\Models\EventAction;
use App\Models\EventSubType;
use App\Models\UserSecurity;
use App\Models\WorkflowStep;
use Livewire\WithPagination;
use App\Models\PanelHazardId;
use App\Mail\responsibilityAction;
use App\Notifications\ToModerator;
use App\Notifications\ToSupervisor;
use Illuminate\Support\Facades\Mail;
use App\Models\WorkflowAdministration;
use Illuminate\Support\Facades\Notification;

class CreateOne extends Component
{
    use WithPagination;
    public $report = '';
    public $followup_action;
    public $actionee_comments = '';
    public $action_condition = '';
    public $due_date = '';
    public $competed = '';
    public $search_reportBy = '';
    public $responsibility;
    public $responsibility_id = '';
    public $event_report_id;
    public $id_details;
    public $pengawas_area_id;
    public $nama_pelapor;
    public $real_id;
    public $task;
    public $hazardClose;
    public $event_subtype;
    public $email_Responsibilty;
    public $modalOpen = '';
    public $reference = '';
    public $modalCreate = 'modal';
    protected $listeners = [

        'pasing_id'
    ];

    public function pasing_id($value)
    {
        if ($value) {

            $this->real_id = $value;
            $hazardID = HazardId::find($this->real_id)->first();
            $this->event_subtype = $hazardID->event_subtype;
            $this->pengawas_area_id =  $hazardID->pengawas_area;
            $this->nama_pelapor =  $hazardID->nama_pelapor;
            $this->reference =  $hazardID->reference;
            $this->task =  $hazardID->task;
        }
    }

    public function render()
    {
        return view('livewire.event-report-list.hazard-id.action.create-one', [
            'Person' => People::with('Employer')->search(trim($this->search_reportBy))->paginate(20),
        ]);
    }
    public function openModalCreate()
    {
        $this->modalCreate = 'modal modal-open';
    }
    public function closeModalCreate()
    {
        $this->modalCreate = 'modal';
    }
    public function openModal()
    {
        $this->modalOpen = 'modal-open';
    }
    public function cari_reportBy($id)
    {

        if (!empty($id)) {
            $reportBy = People::with('Employer')->whereId($id)->first();
            $this->responsibility = $reportBy->lookup_name;
            if (!empty($reportBy->network_username)) {
                $this->email_Responsibilty = $reportBy->network_username;
            }
            $this->responsibility_id = $reportBy->id;
            $this->reportByClickClose();
        } else {
            $this->responsibility_id = 0;
        }
    }
    public function reportByClickClose()
    {

        $this->modalOpen = '';
    }
    public function storeAction()
    {

        if ($this->competed) {
            $this->competed =  date('Y-m-d', strtotime($this->competed));
        } else {
            $this->competed = null;
        }
        if ($this->due_date) {
            $this->due_date =  date('Y-m-d', strtotime($this->due_date));
        } else {
            $this->due_date = null;
        }

        $this->validate([

            'followup_action' => 'required',
            'responsibility' => 'required',
        ]);
        // try {
        EventAction::create([
            'report' => $this->report,
            'followup_action' => $this->followup_action,
            'actionee_comments' => $this->actionee_comments,
            'action_condition' => $this->action_condition,
            'due_date' =>  $this->due_date,
            'competed' => $this->competed,
            'responsibility' => $this->responsibility_id,
            'event_hzd_id' => $this->real_id,
        ]);
        session()->flash('success', 'Data Updated Successfully!!');
        $this->emit('Add_action');
        $workflow_template_id = WorkflowStep::where('workflow_template', 1)->orderBy('id', 'ASC')->first()->workflow_template;
        $description = WorkflowAdministration::with(['StatusCode', 'ResponsibleRole'])->where('workflow_template', $workflow_template_id)->first()->description;
        $b = WorkflowAdministration::with(['StatusCode', 'ResponsibleRole'])->where('description', $description)->first()->id;
        PanelHazardId::create([
            'assignTo' => null,
            'also_assignTo' => null,
            'hazard_id' => $this->real_id,
            'workflow_step' => $b,

        ]);
        $idhazard = $this->real_id;
        $url = "$idhazard";
        $network_username = People::whereIn('network_username', User::get('username'))->pluck('id')->toArray();
        $id_moderator = UserSecurity::whereIn('user_id', $network_username)->where('user_id', 'NOT LIKE', auth()->user()->id)->where('event_types_id', $this->event_subtype)->where('workflow', 'Moderator')->pluck('user_id')->toArray();
        $nameSubType = EventSubType::whereId($this->event_subtype)->first()->EventType->name;

        $people = People::whereIn('id', $id_moderator)->pluck('network_username')->toArray();
        $moderator = User::whereIn('username', $people)->get();
        $reportTo = People::where('id', $this->pengawas_area_id)->first()->network_username;
        session()->flash('success', 'Data added Successfully!!');
        if ($reportTo) {
            $pengawas = User::where('username', $reportTo)->get();

            $offerDataSpv = [
                'name' => 'Report By' . ' ' . $this->nama_pelapor,
                'subject' => $nameSubType,
                'body' => $this->task,
                'thanks' => 'Thank you',
                'offerText' => $this->reference,
                'dateTime' => Carbon::now(+8)->toDateTimeString(),
                'offerUrl' => url("http://tokasafe.tokatindung.com/eventReport/hazard_id/$url"),
                'offer_id' => $url
            ];

            Notification::send($pengawas, new ToSupervisor($offerDataSpv));
        }
        $offerData = [
            'name' => 'Report By' . ' ' . $this->nama_pelapor,
            'subject' => $nameSubType,
            'body' => $this->task,
            'thanks' => 'Thank you',
            'offerText' => $this->reference,
            'dateTime' => Carbon::now(+8)->toDateTimeString(),
            'offerUrl' => url("http://tokasafe.tokatindung.com/eventReport/hazard_id/$url"),
            'offer_id' => $url
        ];
        Notification::send($moderator, new ToModerator($offerData));
        if (auth()->user()->role_users_id == 2) {
            return redirect()->route('hazardDetailsGuest', ['id' =>  $idhazard]);
        } else {

            return redirect()->route('hazardDetails', ['id' =>  $idhazard]);
        }
        $this->clearFields();
        // } 
        // catch (\Throwable $th) {
        //     session()->flash('error', 'something wrong!!');
        // }
    }

    public function clearFields()
    {
        $this->report = '';
        $this->followup_action = '';
        $this->actionee_comments = '';
        $this->action_condition = '';
        $this->due_date = '';
        $this->competed = '';
        $this->responsibility = '';
    }
    public function backTab()
    {
        $this->emit('backTabFunction', $this->real_id);
    }
}
