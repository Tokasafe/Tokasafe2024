<?php

namespace App\Http\Livewire\EventReport\Panel;

use App\Mail\ModeratorEmail;
use App\Mail\SendDemoMail;
use App\Models\People;
use App\Models\StatusEvent;
use App\Models\User;
use App\Models\UserSecurity;
use App\Models\WorkflowAdministration;
use Illuminate\Support\Facades\Mail;
use Livewire\Component;
use Vinkla\Hashids\Facades\Hashids;

class Index extends Component
{
    public $proceed_To = [];
    public $data_id;
    public $proceedTo;
    public $assignTo;
    public $assignToName;
    public $also_assignTo;
    public $also_assignToName;
    public $statusER;
    public $eventReport_id;
    public $current_step;
    public $eventType_id;
    public $currentStep_id;
    public $workgroup;
    public $real_id;
    public $id_people;
    public $destination_1;
    public $destination_2;
    public $destination_1_label;
    public $destination_2_label;
    public $getStatusId;
    public $get_Id;
    public $responsibleRole;
    public $description;
    public $erm;
    public $reportBy;
    public $time;
    public $userController = false;

    public function mount($id)
    {
        $decoded_id = Hashids::decode($id);
        $this->real_id = $id;
        $this->eventReport_id = $decoded_id[0];
        $this->reportBy = StatusEvent::where('event_report_id', $decoded_id[0])->first()->moderator_report;
        $this->time = StatusEvent::where('event_report_id', $decoded_id[0])->first()->updated_at;
        $this->data_id = StatusEvent::where('event_report_id', $this->eventReport_id)->pluck('id')[0];
        $statusEvent = StatusEvent::where('id', $this->data_id)->first();
        $this->eventType_id = $statusEvent->EventReport->type_kejadian;

        $this->description = $statusEvent->EventReport->occupation;
        $this->workgroup = $statusEvent->EventReport->workgroup;
        $this->currentStep_id = $statusEvent->event_status_id;
        $this->current_step = $statusEvent->EventStatus2->name;
        $this->destination_1_label = $statusEvent->EventStatus2->destination_1_label;
        $this->destination_2_label = $statusEvent->EventStatus2->destination_2_label;
        $this->destination_1 = $statusEvent->EventStatus2->destination_1;
        $this->destination_2 = $statusEvent->EventStatus2->destination_2;
        $this->erm = $statusEvent->EventStatus2->destination_2;

        $this->also_assignTo = $statusEvent->also_assignTo;
        $this->assignTo = $statusEvent->assignTo;
        if (!empty($this->assignTo) || !empty($this->also_assignToName)) {

            $this->assignToName = $statusEvent->AssignTo->People->lookup_name;
            $this->also_assignToName = $statusEvent->Also_assignTo->People->lookup_name;
        }
    }
    public function render()
    {
        if (!empty($this->proceedTo)) {
            $this->getStatusId = WorkflowAdministration::where('name', $this->proceedTo)->first()->id;
            $this->responsibleRole = WorkflowAdministration::whereId($this->getStatusId)->first()->responsible_role;
            $this->get_Id = WorkflowAdministration::whereId($this->getStatusId)->first()->status_code;
        }

        if (!empty(People::whereIn('network_username', [auth()->user()->username])->first()->id)) {
            $this->id_people = People::whereIn('network_username', [auth()->user()->username])->first()->id;
            $workflow = UserSecurity::with('People')->whereIn('user_id', [$this->id_people])->pluck('workflow')->toArray();
            dd($workflo);
            $flow = 'Event Report Manager';
            if ($workflow === 'Moderator') {
                $this->userController = true;
            } elseif ($workflow === 'Event Report Manager' && $this->responsibleRole == 1) {
                $this->userController = true;
            } else {
                $this->userController = false;
            }
        } else {
            $flow = '';
        }

        // $this->proceed_To = WorkflowAdministration::where('event_type_id', $this->eventType_id);
        return view('livewire.event-report.panel.index', [
            'People' => UserSecurity::with('People.Employer')->workgroup(trim($this->workgroup))->flow(trim($flow))->get(),
            "StatusEvent" => StatusEvent::where('event_report_id', $this->eventReport_id),
            "Access" => WorkflowAdministration::with(['StatusCode', 'ResponsibleRole'])->where('event_type_id', $this->eventType_id),
        ]);
    }

    public function store()
    {


        if ($this->responsibleRole == 1) {
            $moderatorReport = People::where('network_username', auth()->user()->username)->first()->lookup_name;
            $this->validate([
                'proceedTo' => 'required',
                'assignTo' => 'required',
                'also_assignTo' => 'required',
            ]);
            try {
                StatusEvent::whereId($this->data_id)->update([
                    'event_status_id' => $this->getStatusId,
                    'assignTo' => $this->assignTo,
                    'also_assignTo' => $this->also_assignTo,
                    'moderator_report' => $moderatorReport
                ]);
                $this->statusER = WorkflowAdministration::where('status_code', $this->get_Id)->first()->description;
                $link = $this->real_id;
                $username1 = StatusEvent::where('event_report_id', $this->eventReport_id)->where('assignTo', $this->assignTo)->first()->AssignTo->People->network_username;
                $username2 = StatusEvent::where('event_report_id', $this->eventReport_id)->where('also_assignTo', $this->also_assignTo)->first()->Also_assignTo->People->network_username;
                $network_username = People::whereIn('network_username', [$username1, $username2])->pluck('id')->toArray();
                $id_moderator = UserSecurity::whereIn('user_id', $network_username)->where('workflow', 'Event Report Manager')->pluck('user_id')->toArray();
                $people = People::whereIn('id', $id_moderator)->pluck('network_username')->toArray();
                $moderator = User::whereIn('username', $people)->get();
                $url = "http://tokasafe.tokatindung.com:8080/eventReport/details/$link";
                foreach ($moderator as $key => $user) {

                    Mail::to($user->email)->send(new SendDemoMail($this->description, $this->assignToName, $this->also_assignToName, $url, $this->statusER));
                }
                return redirect()->route('eventReportRegister', ['id' => $this->real_id]);
                $this->emit('PanelTime');
                $this->clearFields();
            } catch (\Exception $ex) {
                session()->flash('success', 'Something goes wrong!!');
            }
        } else {
            $moderatorReport = People::where('network_username', auth()->user()->username)->first()->lookup_name;
            $this->validate([
                'proceedTo' => 'required',
            ]);
            // try {
            StatusEvent::whereId($this->data_id)->update([
                'event_status_id' => $this->getStatusId,
            ]);
            $this->statusER = WorkflowAdministration::where('status_code', $this->get_Id)->first()->description;
            $link = $this->real_id;
            // $username1 = StatusEvent::where('event_report_id', $this->eventReport_id)->where('assignTo', $this->assignTo)->first()->AssignTo->People->network_username;
            $network_username = People::where('network_username', 'not like', auth()->user()->username)->pluck('id')->toArray();
            $id_moderator = UserSecurity::whereIn('user_id', $network_username)->where('workflow', 'Moderator')->pluck('user_id')->toArray();
            $people = People::whereIn('id', $id_moderator)->pluck('network_username')->toArray();
            $moderator = User::whereIn('username', $people)->get();
            $url = "http://tokasafe.tokatindung.com:8080/eventReport/details/$link";
            foreach ($moderator as $key => $user) {

                Mail::to($user->email)->send(new ModeratorEmail($this->description, $url, $this->statusER, $user->name));
            }
            return redirect()->route('eventReportRegister', ['id' => $this->real_id]);
            $this->clearFields();
            // } catch (\Exception $ex) {
            //     session()->flash('error', 'Something goes wrong!!');
            // }
        }
    }
    public function clearFields()
    {
        $this->proceedTo = '';
        $this->assignTo = '';
        $this->also_assignTo = '';
    }
}
