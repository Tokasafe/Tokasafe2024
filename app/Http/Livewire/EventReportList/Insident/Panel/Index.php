<?php

namespace App\Http\Livewire\EventReportList\Insident\Panel;

use Carbon\Carbon;
use App\Models\User;
use App\Models\People;
use Livewire\Component;
use App\Models\UserSecurity;
use App\Notifications\ToERM;
use App\Models\PanelIncident;
use PhpParser\Node\Stmt\TryCatch;
use App\Notifications\ToModerator;
use App\Models\WorkflowAdministration;
use Illuminate\Support\Facades\Notification;

class Index extends Component
{
    public $proceedTo, $requestName, $report_id, $real_id, $Event_Report_Manager;
    public $moderator, $current_step, $reference, $getStatusId, $responsibleRole, $id_people, $get_Id, $userController = false, $event_subtype, $event_type, $workgroup, $status, $destination_1_label, $destination_1, $destination_2_label, $destination_2, $destination_3, $assignTo, $assignToName, $also_assignTo = null, $also_assignToName;
    public function mount($id)
    {
        $this->real_id = $id;
        $data_id = PanelIncident::where('incident_report_id', $id)->first()->id;
        $this->report_id = $data_id;
        $panel = PanelIncident::whereId($data_id)->first();
        $this->moderator = $panel->moderator_report;
        $this->event_type = $panel->Incident->eventType->id;
        $this->event_subtype = $panel->Incident->eventSubType->name;
        $this->workgroup = $panel->Incident->workgroup->id;
        $this->reference = $panel->Incident->reference;
        $this->current_step = $panel->WorkflowStep->name;
        $this->status = $panel->WorkflowStep->StatusCode->name;
        $this->destination_1_label = $panel->WorkflowStep->destination_1_label;
        $this->responsibleRole = $panel->WorkflowStep->id;
        $this->destination_1 = $panel->WorkflowStep->destination_1;
        $this->destination_2_label = $panel->WorkflowStep->destination_2_label;
        $this->destination_2 = $panel->WorkflowStep->destination_2;
        $this->destination_3 = $panel->WorkflowStep->checkCancel;
        if (!empty($panel->assignTo)) {
            $this->assignTo = $panel->assignTo;
            $this->assignToName = $panel->AssignTo->lookup_name;
        }
        if (!empty($panel->also_assignTo)) {
            $this->also_assignTo = $panel->also_assignTo;
            $this->also_assignToName = $panel->Also_assignTo->lookup_name;
        }
        if (!empty(People::whereIn('network_username', [auth()->user()->username])->first()->id)) {
            $this->id_people = People::whereIn('network_username', [auth()->user()->username])->first()->id;
            $workflow = UserSecurity::with('People')->where('user_id', $this->id_people)->whereIn('workflow', ['Moderator', 'Event Report Manager'])->pluck('workflow')->toArray();
            $this->Event_Report_Manager = 'Event Report Manager';
            $nameStep = 'Assign & Investigation';
            if (in_array('Moderator', $workflow)) {
                $this->userController = true;
            } elseif (in_array('Event Report Manager', $workflow) && $this->current_step === $nameStep && $this->assignTo === $this->id_people) {
                $this->userController = true;
            } elseif (in_array('Event Report Manager', $workflow) && $this->current_step === $nameStep &&  $this->also_assignTo === $this->id_people) {
                $this->userController = true;
            } else {
                $this->userController = false;
            }
        } else {
            $this->Event_Report_Manager = '';
        }
    }
    protected $listeners = ['updateIncident' => 'render'];
    public function render()
    {
        if ($this->proceedTo) {
            $this->getStatusId = WorkflowAdministration::where('workflow_template', 2)->where('name', $this->proceedTo)->first()->id;
            $this->responsibleRole = WorkflowAdministration::whereId($this->getStatusId)->first()->id;
            $this->get_Id = WorkflowAdministration::whereId($this->getStatusId)->first()->status_code;
        } else {
            $this->responsibleRole = 0;
        }

        return view('livewire.event-report-list.insident.panel.index', [
            'People' => UserSecurity::with('People.Employer')->where('event_types_id', $this->event_type)->workgroup(trim($this->workgroup))->flow(trim($this->Event_Report_Manager))->get(),
            'Workflow' => WorkflowAdministration::where('workflow_template', 2)->where('name', $this->current_step)->get()
        ]);
    }
    public function storeUpdate()
    {


        $moderatorReport = People::where('network_username', auth()->user()->username)->first()->lookup_name;
        $url = $this->real_id;
        if ($this->responsibleRole == 6) {
            if (!empty($this->assignTo) && empty($this->also_assignTo)) {
                $this->assignToName = People::find($this->assignTo)->lookup_name;
                $this->requestName = 'Hi' . ' ' . $this->assignToName;
            }
            if ($this->assignTo && $this->also_assignTo) {
                $this->assignToName = People::find($this->assignTo)->lookup_name;
                if (is_int($this->also_assignTo) == false) {
                    $this->also_assignTo = null;
                } else {
                    $this->also_assignToName = People::find($this->also_assignTo)->lookup_name;
                    $this->requestName = 'Hi' . ' ' . $this->assignToName . ' & ' . $this->also_assignToName;
                }
            }
            $userSecurity = UserSecurity::whereIn('user_id', [$this->assignTo, $this->also_assignTo])->where('workflow', 'Event Report Manager')->pluck('user_id')->toArray();
            $people = People::whereIn('id', $userSecurity)->pluck('network_username')->toArray();
            $User = User::whereIn('username', $people)->get();
            foreach ($User as $key => $user) {
                if ($user->role_users_id == 1) {
                    $user_security = User::whereIn('username', $people)->where('role_users_id', 1)->get();
                    $offerData = [
                        'name' => $this->requestName,
                        'subject' => $this->event_subtype,
                        'body2' => "Moderator reopened this report",
                        'body' => 'Please check by click the button below',
                        'thanks' => 'Thank you',
                        'offerText' => $this->reference,
                        'offerUrl' => url("http://tokasafe.tokatindung.com/eventReport/incident/$url"),
                        'offer_id' => $this->real_id,
                        'dateTime' => Carbon::now(+8)->toDateTimeString()
                    ];
                    Notification::send($user_security, new ToERM($offerData));
                } else {
                    $user_security = User::whereIn('username', $people)->where('role_users_id', 2)->get();
                    $offerData = [
                        'name' => $this->requestName,
                        'subject' => $this->event_subtype,
                        'body2' => 'Moderator reopened this report',
                        'body' => 'Please click the button below',
                        'thanks' => 'Thank you',
                        'offerText' => $this->reference,
                        'offerUrl' => url("http://tokasafe.tokatindung.com/user/eventReport/incident/$url"),
                        'offer_id' => $this->real_id,
                        'dateTime' => Carbon::now(+8)->toDateTimeString()
                    ];
                    Notification::send($user_security, new ToERM($offerData));
                }
            }
            $this->validate([
                'proceedTo' => 'required',
                'assignTo' => 'required',
                'also_assignTo' => 'nullable',
            ]);
            try {
                PanelIncident::whereId($this->report_id)->update([
                    'workflow_step' => $this->getStatusId,
                    'assignTo' => $this->assignTo,
                    'also_assignTo' => $this->also_assignTo,
                    'moderator_report' => $moderatorReport
                ]);

                if (auth()->user()->role_users_id == 2) {
                    return redirect()->route('incidentDetailsGuest', ['id' =>  $this->real_id]);
                } else {
                    return redirect()->route('incidentDetails', ['id' =>  $this->real_id]);
                }
            } catch (\Throwable $th) {
                session()->flash('error', "Something goes wrong!!");
            }
        } elseif ($this->responsibleRole == 7) {

            $this->validate([
                'proceedTo' => 'required',
                'assignTo' => 'required',
                'also_assignTo' => 'nullable',
            ]);
           
           
                $this->assignToName = People::find($this->assignTo)->lookup_name;
                if (empty($this->also_assignTo)) {
                    
                    $this->also_assignTo = null;
                } else {
                   
                    $this->also_assignToName = People::find($this->also_assignTo)->lookup_name;
                    $this->requestName = 'Hi' . ' ' . $this->assignToName . ' & ' . $this->also_assignToName;
                }
           
            $userSecurity =  UserSecurity::whereIn('user_id', [$this->assignTo, $this->also_assignTo])->where('workflow', 'Event Report Manager')->pluck('user_id')->toArray();
            $people = People::whereIn('id', $userSecurity)->pluck('network_username')->toArray();
            $User = User::whereIn('username', $people)->get();
            foreach ($User as $key => $user) {
                if ($user->role_users_id == 1) {
                    $user_security = User::whereIn('username', $people)->where('role_users_id', 1)->get();
                    $offerData = [
                        'name' => $this->requestName,
                        'subject' => $this->event_subtype,
                        'body2' => 'Moderator Assigns this Incident report to you',
                        'body' => 'Please click the button below',
                        'thanks' => 'Thank you',
                        'offerText' => $this->reference,
                        'offerUrl' => url("http://tokasafe.tokatindung.com/eventReport/incident/$url"),
                        'offer_id' => $this->real_id,
                        'dateTime' => Carbon::now(+8)->toDateTimeString()
                    ];
                    Notification::send($user_security, new ToERM($offerData));
                } else {
                    $user_security = User::whereIn('username', $people)->where('role_users_id', 2)->get();
                    $offerData = [
                        'name' => $this->requestName,
                        'subject' => $this->event_subtype,
                        'body2' => 'Moderator Assigns this Incident report to you',
                        'body' => 'Please click the button below',
                        'thanks' => 'Thank you',
                        'offerText' => $this->reference,
                        'offerUrl' => url("http://tokasafe.tokatindung.com/user/eventReport/incident/$url"),
                        'offer_id' => $this->real_id,
                        'dateTime' => Carbon::now(+8)->toDateTimeString()
                    ];
                    Notification::send($user_security, new ToERM($offerData));
                }
            }

            PanelIncident::whereId($this->report_id)->update([
                'workflow_step' => $this->getStatusId,
                'assignTo' => $this->assignTo,
                'also_assignTo' => $this->also_assignTo,
                'moderator_report' => $moderatorReport
            ]);
            if (auth()->user()->role_users_id == 2) {
                return redirect()->route('incidentDetailsGuest', ['id' =>  $this->real_id]);
            } else {
                return redirect()->route('incidentDetails', ['id' =>  $this->real_id]);
            }
        } elseif ($this->responsibleRole == 8) {

            $lookupName = People::where('network_username', 'like', auth()->user()->username)->first()->lookup_name;
            $userSecurity = UserSecurity::where('workflow', 'Moderator')->pluck('user_id')->toArray();
            $people = People::whereIn('id', $userSecurity)->pluck('network_username')->toArray();
            $User = User::whereIn('username', $people)->get();
            foreach ($User as $key => $user) {
                if ($user->role_users_id == 1) {
                    $user_security = User::whereIn('username', $people)->where('role_users_id', 1)->get();
                    $offerData = [
                        'name' => "Hi, Moderator",
                        'subject' => $this->event_subtype,
                        'body' => "$lookupName has carried out the assigned tasks",
                        'thanks' => 'Thank you',
                        'offerText' => $this->reference,
                        'offerUrl' => url("http://tokasafe.tokatindung.com/eventReport/incident/$url"),
                        'offer_id' => $this->real_id,
                        'dateTime' => Carbon::now(+8)->toDateTimeString()
                    ];
                    Notification::send($user_security, new ToModerator($offerData));
                }
            }
            $this->validate([
                'proceedTo' => 'required',
                'assignTo' => 'required',
                'also_assignTo' => 'nullable',
            ]);
            PanelIncident::whereId($this->report_id)->update([
                'workflow_step' => $this->getStatusId,
                'assignTo' => $this->assignTo,
                'also_assignTo' => $this->also_assignTo,
                'moderator_report' => $this->moderator

            ]);
            if (auth()->user()->role_users_id == 2) {
                return redirect()->route('incidentDetailsGuest', ['id' =>  $this->real_id]);
            } else {
                return redirect()->route('incidentDetails', ['id' =>  $this->real_id]);
            }
        } elseif ($this->responsibleRole == 9) {
            if (!empty($this->assignTo) && empty($this->also_assignTo)) {
                $this->assignToName = People::find($this->assignTo)->lookup_name;
                $this->requestName = 'Hi' . ' ' . $this->assignToName;
            }
            if ($this->assignTo && $this->also_assignTo) {
                $this->assignToName = People::find($this->assignTo)->lookup_name;
                if (is_int($this->also_assignTo) == false) {
                    $this->also_assignTo = null;
                } else {
                    $this->also_assignToName = People::find($this->also_assignTo)->lookup_name;
                    $this->requestName = 'Hi' . ' ' . $this->assignToName . ' & ' . $this->also_assignToName;
                }
            }
            $userSecurity =  UserSecurity::whereIn('user_id', [$this->assignTo, $this->also_assignTo])->where('workflow', 'Event Report Manager')->pluck('user_id')->toArray();
            $people = People::whereIn('id', $userSecurity)->pluck('network_username')->toArray();
            $User = User::whereIn('username', $people)->get();
            foreach ($User as $key => $user) {
                if ($user->role_users_id == 1) {
                    $user_security = User::whereIn('username', $people)->where('role_users_id', 1)->get();
                    $offerData = [
                        'name' => $this->requestName,
                        'subject' => $this->event_subtype,
                        'body2' => "Moderator has Closed this report",
                        'body' => 'Please click the button below',
                        'thanks' => 'Thank you',
                        'offerText' => $this->reference,
                        'offerUrl' => url("http://tokasafe.tokatindung.com/eventReport/incident/$url"),
                        'offer_id' => $this->real_id,
                        'dateTime' => Carbon::now(+8)->toDateTimeString()
                    ];
                    Notification::send($user_security, new ToERM($offerData));
                } else {
                    $user_security = User::whereIn('username', $people)->where('role_users_id', 2)->get();
                    $offerData = [
                        'name' => $this->requestName,
                        'subject' => $this->event_subtype,
                        'body2' => 'Moderator has Closed this report',
                        'body' => 'Please click the button below',
                        'thanks' => 'Thank you',
                        'offerText' => $this->reference,
                        'offerUrl' => url("http://tokasafe.tokatindung.com/user/eventReport/incident/$url"),
                        'offer_id' => $this->real_id,
                        'dateTime' => Carbon::now(+8)->toDateTimeString()
                    ];
                    Notification::send($user_security, new ToERM($offerData));
                }
            }
            $this->validate([
                'proceedTo' => 'required',
                'assignTo' => 'required',
                'also_assignTo' => 'nullable',
            ]);
            PanelIncident::whereId($this->report_id)->update([
                'workflow_step' => $this->getStatusId,
                'assignTo' => $this->assignTo,
                'also_assignTo' => $this->also_assignTo,
                'moderator_report' => $this->moderator

            ]);

            if (auth()->user()->role_users_id == 2) {
                return redirect()->route('incidentDetailsGuest', ['id' =>  $this->real_id]);
            } else {
                return redirect()->route('incidentDetails', ['id' =>  $this->real_id]);
            }
        } else {
            if (!empty($this->assignTo) && empty($this->also_assignTo)) {
                $this->assignToName = People::find($this->assignTo)->lookup_name;
                $this->requestName = 'Hi' . ' ' . $this->assignToName;
            }
            if ($this->assignTo && $this->also_assignTo) {
                $this->assignToName = People::find($this->assignTo)->lookup_name;
                if (is_int($this->also_assignTo) == false) {
                    $this->also_assignTo = null;
                } else {
                    $this->also_assignToName = People::find($this->also_assignTo)->lookup_name;
                    $this->requestName = 'Hi' . ' ' . $this->assignToName . ' & ' . $this->also_assignToName;
                }
            }
            $userSecurity =  UserSecurity::whereIn('user_id', [$this->assignTo, $this->also_assignTo])->where('workflow', 'Event Report Manager')->pluck('user_id')->toArray();
            $people = People::whereIn('id', $userSecurity)->pluck('network_username')->toArray();
            $User = User::whereIn('username', $people)->get();
            foreach ($User as $key => $user) {
                if ($user->role_users_id == 1) {
                    $user_security = User::whereIn('username', $people)->where('role_users_id', 1)->get();
                    $offerData = [
                        'name' => $this->requestName,
                        'subject' => $this->event_subtype,
                        'body2' => "Moderator has Cancelled this report",
                        'body' => 'Please click the button below',
                        'thanks' => 'Thank you',
                        'offerText' => $this->reference,
                        'offerUrl' => url("http://tokasafe.tokatindung.com/eventReport/incident/$url"),
                        'offer_id' => $this->real_id,
                        'dateTime' => Carbon::now(+8)->toDateTimeString()
                    ];
                    Notification::send($user_security, new ToERM($offerData));
                }
            }
            $this->validate([
                'proceedTo' => 'required',
                'assignTo' => 'required',
                'also_assignTo' => 'nullable',
            ]);
            PanelIncident::whereId($this->report_id)->update([
                'workflow_step' => $this->getStatusId,
                'assignTo' => $this->assignTo,
                'also_assignTo' => $this->also_assignTo,
                'moderator_report' => $this->moderator

            ]);
            if (auth()->user()->role_users_id == 2) {
                return redirect()->route('incidentDetailsGuest', ['id' =>  $this->real_id]);
            } else {
                return redirect()->route('incidentDetails', ['id' =>  $this->real_id]);
            }
        }
    }
}
