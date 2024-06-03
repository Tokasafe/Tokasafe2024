<?php

namespace App\Http\Livewire\EventReportList\HazardId\Panel;

use Carbon\Carbon;
use App\Models\User;
use App\Models\People;
use Livewire\Component;
use App\Models\EventSubType;
use App\Models\UserSecurity;
use App\Notifications\ToERM;
use Livewire\WithPagination;
use App\Models\PanelHazardId;
use App\Notifications\ToModerator;
use App\Models\WorkflowAdministration;
use Illuminate\Support\Facades\Notification;

class Index extends Component
{
    use WithPagination;
    public $destination_1_label;
    public $destination_1;
    public $destination_2_label;
    public $destination_2;
    public $destination_3;
    public $getStatusId;
    public $responsibleRole, $event_subtype;
    public $moderator, $rincian_bahaya;
    public $time, $eventSubType;
    public $get_Id;
    public $workgroup;
    public $current_step;
    public $id_people;
    public $proceedTo;
    public $assignTo;
    public $also_assignTo;
    public $assignToName;
    public $also_assignToName, $requestName = [];

    public $event_type;
    public $status;
    public $description;
    public $data_id;
    public $real_id, $namapelapor;
    public $reference;
    public $userController = false;
    protected $listeners = [
        'panel' => 'render',
    ];
    public function mount($id)
    {
        $IdPanelHazard = PanelHazardId::where('hazard_id', $id)->first()->id;
        $this->data_id = $IdPanelHazard;
        $this->real_id = $id;

        $statusEvent = PanelHazardId::whereId($IdPanelHazard)->first();
        $this->moderator = $statusEvent->moderator_report;
        $this->time = date('d-m-y, H:i', strtotime($statusEvent->updated_at));
        $this->workgroup = $statusEvent->Hazard->workgroup;
        $this->reference = $statusEvent->Hazard->reference;
        $this->namapelapor = $statusEvent->Hazard->People->lookup_name;;
        $this->rincian_bahaya = $statusEvent->Hazard->rincian_bahaya;
        $this->event_type = $statusEvent->Hazard->EventSubType->eventType_id;
        $this->event_subtype = $statusEvent->Hazard->EventSubType->EventType->id;
        $this->current_step = $statusEvent->WorkflowStep->name;
        $this->status = $statusEvent->WorkflowStep->StatusCode->name;
        $this->destination_1_label = $statusEvent->WorkflowStep->destination_1_label;
        $this->destination_1 = $statusEvent->WorkflowStep->destination_1;
        $this->destination_2_label = $statusEvent->WorkflowStep->destination_2_label;
        $this->destination_2 = $statusEvent->WorkflowStep->destination_2;
        $this->destination_3 = $statusEvent->WorkflowStep->checkCancel;
        if (!empty($statusEvent->assignTo)) {
            $this->assignTo = $statusEvent->assignTo;
            $this->assignToName = $statusEvent->AssignTo->lookup_name;
        }
        if (!empty($statusEvent->also_assignTo)) {
            $this->also_assignTo = $statusEvent->also_assignTo;
            $this->also_assignToName = $statusEvent->Also_assignTo->lookup_name;
        }
    }
    public function render()
    {
        if (!empty($this->proceedTo)) {
            $this->getStatusId = WorkflowAdministration::where('name', $this->proceedTo)->first()->id;
            $this->responsibleRole = WorkflowAdministration::whereId($this->getStatusId)->first()->id;
            $this->get_Id = WorkflowAdministration::whereId($this->getStatusId)->first()->status_code;
        } else {
            $this->responsibleRole = 0;
        }
        if (!empty(People::whereIn('network_username', [auth()->user()->username])->first()->id)) {
            $this->id_people = People::whereIn('network_username', [auth()->user()->username])->first()->id;
            $workflow = UserSecurity::with('People')->where('user_id', $this->id_people)->whereIn('workflow', ['Moderator', 'Event Report Manager'])->pluck('workflow')->toArray();
            $erm = 'Event Report Manager';
            $nameStep = 'ERM Assigned';
            if (in_array('Moderator', $workflow)) {
                $this->userController = true;
            } elseif (in_array('Event Report Manager', $workflow) && $this->current_step === $nameStep) {
                $this->userController = true;
            } else {
                $this->userController = false;
            }
        } else {
            $erm = '';
        }
        return view('livewire.event-report-list.hazard-id.panel.index', [
            'People' => UserSecurity::with('People.Employer')->where('event_types_id', $this->event_type)->workgroup(trim($this->workgroup))->flow(trim($erm))->get(),
            'Workflow' => WorkflowAdministration::where('workflow_template', 1)->where('name', $this->current_step)->get()
        ]);
    }
    public function store()
    {
        if (!empty($this->assignTo) && empty($this->also_assignTo)) {
            $this->requestName = 'Hallo' . ' ' . $this->assignToName;
        }
        if (!empty($this->assignTo) && !empty($this->also_assignTo)) {
            $this->requestName = 'Hallo' . ' ' . $this->assignToName . ' & ' . $this->also_assignToName;
        }
        $moderatorReport = People::where('network_username', auth()->user()->username)->first()->lookup_name;
        $url = $this->real_id;
        if ($this->responsibleRole == 1) {
          
            $userSecurity = UserSecurity::whereIn('user_id', [$this->assignTo, $this->also_assignTo])->where('workflow', 'Event Report Manager')->pluck('user_id')->toArray();
            $people = People::whereIn('id', $userSecurity)->pluck('network_username')->toArray();
            $User = User::whereIn('username', $people)->get();
            foreach ($User as $key => $user) {
                if ($user->role_users_id == 1) {
                    $user_security1 = User::whereIn('username', $people)->where('role_users_id', 1)->get();
                    $offerData = [
                        'name' => $this->requestName,
                        'subject' => $this->event_subtype,
                        'body2' => "Moderator reopened this report",
                        'body' => 'Please check by click the button below',
                        'thanks' => 'Thank you',
                        'offerText' => $this->reference,
                        'offerUrl' => url("http://tokasafe.tokatindung.com/eventReport/hazard_id/$url"),
                        'offer_id' => $this->real_id,
                        'dateTime' => Carbon::now(+8)->toDateTimeString()
                    ];
                    Notification::send($user_security1, new ToERM($offerData));
                }
            }
            $this->validate([
                // 'proceedTo' => 'required',
                // 'assignTo' => 'required',
                'also_assignTo' => 'nullable',
            ]);
            try {
                PanelHazardId::whereId($this->data_id)->update([
                    'workflow_step' => $this->getStatusId,
                    'assignTo' => $this->assignTo,
                    'also_assignTo' => $this->also_assignTo,
                    'moderator_report' => $moderatorReport
                ]);

                if (auth()->user()->role_users_id == 2) {
                    return redirect()->route('hazardDetailsGuest', ['id' =>  $this->real_id]);
                } else {
                    return redirect()->route('hazardDetails', ['id' =>  $this->real_id]);
                }
            } catch (\Throwable $th) {
                session()->flash('error', "Something goes wrong!!");
            }
        } elseif ($this->responsibleRole == 2) {

            $this->validate([
                'proceedTo' => 'required',
                'assignTo' => 'required',
                'also_assignTo' => 'nullable',
                
            ]);
            $userSecurity =  UserSecurity::whereIn('user_id', [$this->assignTo, $this->also_assignTo])->where('workflow', 'Event Report Manager')->pluck('user_id')->toArray();
            $people = People::whereIn('id', $userSecurity)->pluck('network_username')->toArray();
            $User = User::whereIn('username', $people)->get();
            foreach ($User as $key => $value) {
                if ($value->role_users_id == 1) {
                    $moderator1 = User::whereIn('username', $people)->where('role_users_id', 1)->get();
                    $offerData = [
                        'name' => $this->requestName,
                        'subject' => $this->event_subtype,
                        'body2' => 'The Moderator assigned this hazard report to you',
                        'body' => 'Please check by click the button below',
                        'thanks' => 'Thank you',
                        'offerText' => $this->reference,
                        'offerUrl' => url("http://tokasafe.tokatindung.com/eventReport/hazard_id/$url"),
                        'offer_id' => $url,
                        'dateTime' => Carbon::now(+8)->toDateTimeString()
                    ];
                    Notification::send($moderator1, new ToERM($offerData));
                }
                if ($value->role_users_id == 2) {
                    $moderator2 = User::whereIn('username', $people)->where('role_users_id', 2)->get();
                    $offerData = [
                        'name' => $this->requestName,
                        'subject' => $this->event_subtype,
                        'body2' => 'The Moderator assigned this hazard report to you',
                        'body' => 'Please check by click the button below',
                        'thanks' => 'Thank you',
                        'offerText' => $this->reference,
                        'offerUrl' => url("http://tokasafe.tokatindung.com/user/eventReport/hazard_id/$url"),
                        'offer_id' => $url,
                        'dateTime' => Carbon::now(+8)->toDateTimeString()
                    ];
                    Notification::send($moderator2, new ToERM($offerData));
                }
            }
            try {
                PanelHazardId::whereId($this->data_id)->update([
                    'workflow_step' => $this->getStatusId,
                    'assignTo' => $this->assignTo,
                    'also_assignTo' => $this->also_assignTo,
                    'moderator_report' => $moderatorReport
                ]);
                if (auth()->user()->role_users_id == 2) {
                    return redirect()->route('hazardDetailsGuest', ['id' =>  $this->real_id]);
                } else {
                    return redirect()->route('hazardDetails', ['id' =>  $this->real_id]);
                }
                $this->clearFields();
            } catch (\Exception $ex) {
                session()->flash('success', 'Something goes wrong!!');
            }
        } elseif ($this->responsibleRole == 3) {
            $this->validate([
                'proceedTo' => 'required',
                'assignTo' => 'required',
                'also_assignTo' => 'nullable',
            ]);
            try {
                $lookupName = People::where('network_username', 'like', auth()->user()->username)->first()->lookup_name;
                $userSecurity = UserSecurity::where('workflow', 'Moderator')->pluck('user_id')->toArray();
                $people = People::whereIn('id', $userSecurity)->pluck('network_username')->toArray();
                $User = User::whereIn('username', $people)->get();
                foreach ($User as $key => $value) {
                    $nameModerator =People::where('network_username', 'like', $value->username)->first()->lookup_name;
                    if ($value->role_users_id == 1) {
                        $moderator1 = User::whereIn('username', $people)->where('role_users_id', 1)->get();
                        $offerData = [
                            'name' =>"Hi,  $nameModerator",
                            'subject' => $this->event_subtype,
                            'body' => "$lookupName has carried out the assigned tasks",
                            'thanks' => 'Thank you',
                            'offerText' => $this->reference,
                            'offerUrl' => url("http://tokasafe.tokatindung.com/eventReport/hazard_id/$url"),
                            'offer_id' => $url,
                            'dateTime' => Carbon::now(+8)->toDateTimeString()
                        ];
                        Notification::send($moderator1, new ToModerator($offerData));
                    }
                    if ($value->role_users_id == 2) {
                        $moderator2 = User::whereIn('username', $people)->where('role_users_id', 2)->get();
                        $offerData = [
                            'name' =>"Hi,  $nameModerator",
                            'subject' => $this->event_subtype,
                            'body' => "$lookupName has carried out the assigned tasks",
                            'thanks' => 'Thank you',
                            'offerText' => $this->reference,
                            'offerUrl' => url("http://tokasafe.tokatindung.com/user/eventReport/hazard_id/$url"),
                            'offer_id' => $url,
                            'dateTime' => Carbon::now(+8)->toDateTimeString()
                        ];
                        Notification::send($moderator2, new ToModerator($offerData));
                    }
                }
                PanelHazardId::whereId($this->data_id)->update([
                    'workflow_step' => $this->getStatusId,
                    'assignTo' => $this->assignTo,
                    'also_assignTo' => $this->also_assignTo,
                    'moderator_report' => $this->moderator

                ]);
                if (auth()->user()->role_users_id == 2) {
                    return redirect()->route('hazardDetailsGuest', ['id' =>  $this->real_id]);
                } else {
                    return redirect()->route('hazardDetails', ['id' =>  $this->real_id]);
                }
                $this->clearFields();
            } catch (\Exception $ex) {
                session()->flash('success', 'Something goes wrong!!');
            }
        } elseif ($this->responsibleRole == 4) {

            $this->validate([
                'proceedTo' => 'required',
            ]);
            try {
                $userSecurity =  UserSecurity::whereIn('user_id', [$this->assignTo, $this->also_assignTo])->where('workflow', 'Event Report Manager')->pluck('user_id')->toArray();
                $people = People::whereIn('id', $userSecurity)->pluck('network_username')->toArray();
                $User = User::whereIn('username', $people)->get();
                foreach ($User as $key => $value) {
                    if ($value->role_users_id == 1) {
                        $moderator1 = User::whereIn('username', $people)->where('role_users_id', 1)->get();
                        $offerData = [
                            'name' => $this->requestName,
                            'subject' => $this->event_subtype,
                            'body2' => "Moderator has Closed this report",
                            'body' => 'Please click the button below',
                            'thanks' => 'Thank you',
                            'offerText' => $this->reference,
                            'offerUrl' => url("http://tokasafe.tokatindung.com/eventReport/hazard_id/$url"),
                            'offer_id' => $url,
                            'dateTime' => Carbon::now(+8)->toDateTimeString()
                        ];
                        Notification::send($moderator1, new ToERM($offerData));
                    }
                    if ($value->role_users_id == 2) {
                        $moderator2 = User::whereIn('username', $people)->where('role_users_id', 2)->get();
                        $offerData = [
                            'name' => $this->requestName,
                            'subject' => $this->event_subtype,
                            'body2' => "Moderator has Closed this report",
                            'body' => 'Please click the button below',
                            'thanks' => 'Thank you',
                            'offerText' => $this->reference,
                            'offerUrl' => url("http://tokasafe.tokatindung.com/user/eventReport/hazard_id/$url"),
                            'offer_id' => $url,
                            'dateTime' => Carbon::now(+8)->toDateTimeString()
                        ];
                        Notification::send($moderator2, new ToERM($offerData));
                    }
                }
                PanelHazardId::whereId($this->data_id)->update([
                    'workflow_step' => $this->getStatusId,
                    'assignTo' => $this->assignTo,
                    'also_assignTo' => $this->also_assignTo,
                    'moderator_report' => $this->moderator
                ]);
                if (auth()->user()->role_users_id == 2) {
                    return redirect()->route('hazardDetailsGuest', ['id' =>  $this->real_id]);
                } else {

                    return redirect()->route('hazardDetails', ['id' =>  $this->real_id]);
                }
                $this->clearFields();
            } catch (\Exception $ex) {
                session()->flash('error', 'Something goes wrong!!');
            }
        } else {
            $this->validate([
                'proceedTo' => 'required',
            ]);
            try {
                $userSecurity =  UserSecurity::whereIn('user_id', [$this->assignTo, $this->also_assignTo])->where('workflow', 'Event Report Manager')->pluck('user_id')->toArray();
                $people = People::whereIn('id', $userSecurity)->pluck('network_username')->toArray();
                $User = User::whereIn('username', $people)->get();
                foreach ($User as $key => $value) {
                    if ($value->role_users_id == 1) {
                        $moderator1 = User::whereIn('username', $people)->where('role_users_id', 1)->get();
                        $offerData = [
                            'name' => $this->requestName,
                            'subject' => $this->event_subtype,
                            'body2' => "Moderator has Cancelled this report",
                            'body' => 'Please click the button below',
                            'thanks' => 'Thank you',
                            'offerText' => $this->reference,
                            'offerUrl' => url("http://tokasafe.tokatindung.com/eventReport/hazard_id/$url"),
                            'offer_id' => $url,
                            'dateTime' => Carbon::now(+8)->toDateTimeString()
                        ];
                        Notification::send($moderator1, new ToERM($offerData));
                    }
                    if ($value->role_users_id == 2) {
                        $moderator2 = User::whereIn('username', $people)->where('role_users_id', 2)->get();
                        $offerData = [
                            'name' => $this->requestName,
                            'subject' => $this->event_subtype,
                            'body2' => "Moderator has Cancelled this report",
                            'body' => 'Please click the button below',
                            'thanks' => 'Thank you',
                            'offerText' => $this->reference,
                            'offerUrl' => url("http://tokasafe.tokatindung.com/user/eventReport/hazard_id/$url"),
                            'offer_id' => $url,
                            'dateTime' => Carbon::now(+8)->toDateTimeString()
                        ];
                        Notification::send($moderator2, new ToERM($offerData));
                    }
                }
                PanelHazardId::whereId($this->data_id)->update([
                    'workflow_step' => $this->getStatusId,
                    'assignTo' => $this->assignTo,
                    'also_assignTo' => $this->also_assignTo,
                    'moderator_report' => $this->moderator
                ]);
                if (auth()->user()->role_users_id == 2) {
                    return redirect()->route('hazardDetailsGuest', ['id' =>  $this->real_id]);
                } else {

                    return redirect()->route('hazardDetails', ['id' =>  $this->real_id]);
                }
                $this->clearFields();
            } catch (\Exception $ex) {
                session()->flash('error', 'Something goes wrong!!');
            }
        }
        $this->emit('panel');
    }
}
