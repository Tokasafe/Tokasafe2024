<?php

namespace App\Http\Livewire\EventReportList\HazardId\Action;

use App\Models\People;
use Livewire\Component;
use App\Models\EventAction;
use App\Models\UserSecurity;
use Livewire\WithPagination;
use App\Models\PanelHazardId;

class Index extends Component
{
    use WithPagination;
    public $ID_Details,$WorkflowStep_name,$assignTo,$also_assignTo,$guest_respons = false;
    public $delete_id;
    public $hazardClose;
    protected $listeners = [
        'Add_action' => 'render',
        'up_action' => 'render',
    ];
    public function mount($id)
    {
        $this->ID_Details = $id;
       
        $close = PanelHazardId::where('hazard_id',$this->ID_Details)->first()->WorkflowStep->name;
        if ($close ==='Closed' || $close ==='Cancelled') {
            $this->hazardClose = $close; 
        }
        $this->WorkflowStep_name = PanelHazardId::where('hazard_id', $this->ID_Details)->first()->WorkflowStep->name;
            $panel = PanelHazardId::where('hazard_id',$this->ID_Details)->first();
          
            if ($panel->assignTo) {
                $this->assignTo = $panel->assignTo;
            }
            if ($panel->also_assignTo) {
                $this->also_assignTo = $panel->also_assignTo;
            }
        if (!empty(People::whereIn('network_username', [auth()->user()->username])->first()->id)) {
            $id_people = People::whereIn('network_username', [auth()->user()->username])->first()->id;
            $workflow = UserSecurity::with('People')->where('user_id', $id_people)->whereIn('workflow', ['Moderator', 'Event Report Manager'])->pluck('workflow')->toArray();
            $nameStep = 'ERM Assigned';
            if (in_array('Moderator', $workflow)) {
                $this->guest_respons = true;
            } elseif (in_array('Event Report Manager', $workflow) && $this->WorkflowStep_name === $nameStep && $this->assignTo === $id_people) {
                $this->guest_respons = true;
            } elseif (in_array('Event Report Manager', $workflow) && $this->WorkflowStep_name === $nameStep &&  $this->also_assignTo === $id_people) {
                $this->guest_respons = true;
            } else {
                $this->guest_respons = false;
            }
        } 
    }
    public function render()
    {
        return view('livewire.event-report-list.hazard-id.action.index',[
            'EventAction' => EventAction::with(['People','HazardId'])->where('event_hzd_id',$this->ID_Details)->paginate(5),
        ]);
    }

    public function update($id)
    {
        $this->emit('EventActionUp', $id);
    }
    public function deleteAction($id)
    {
        // dd($id);
        $this->delete_id = $id;
    }
    public function paginationView()
    {
        return 'livewire.pagination';
    }
    public function deleteFileAction()
    {
        try {
            EventAction::find($this->delete_id)->delete();
            session()->flash('success', "Deleted Successfully!!");
        } catch (\Exception $e) {
            session()->flash('error', "Something goes wrong!!");
        }
    }
}
