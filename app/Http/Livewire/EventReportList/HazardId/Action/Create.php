<?php

namespace App\Http\Livewire\EventReportList\HazardId\Action;

use App\Models\User;
use App\Models\People;
use Livewire\Component;
use App\Models\HazardId;
use App\Models\EventAction;
use App\Models\PanelHazardId;
use App\Mail\responsibilityAction;
use Illuminate\Support\Facades\Mail;
use Livewire\WithPagination;

class Create extends Component
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
    public $responsibility_id='';
    public $event_report_id;
    public $id_details;
    public $real_id;
    public $hazardClose;
    public $email_Responsibilty;
    public $modalOpen = '';
    public function mount($id)
    {
        $this->real_id = $id;
        $close = PanelHazardId::where('hazard_id',$this->real_id)->first()->WorkflowStep->name;
        if ($close ==='Closed' || $close ==='Cancelled') {
            $this->hazardClose = $close;
        }
        $ER = HazardId::whereid($this->real_id)->first();
       $this->report = $ER->rincian_bahaya;
    }
    public function render()
    {
        return view('livewire.event-report-list.hazard-id.action.create',[
            'Person' => People::with('Employer')->search(trim($this->search_reportBy))->paginate(20),
        ]);
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
        }
        else{
            $this->responsibility_id = 0;
         
        }
    }
    public function reportByClickClose()
    {

        $this->modalOpen = '';
    }
    public function storeAction()
    {
       
        if (!empty($this->competed)) {
            $this->competed =  date('Y-m-d', strtotime($this->competed));
        } else {
            $this->competed=null;
        }
        if (!empty($this->due_date)) {
            $this->due_date =  date('Y-m-d', strtotime($this->due_date));
        } else {
            $this->due_date=null;
        }
        
        $this->validate([

            'followup_action' => 'required',
            'responsibility' => 'required',
        ]);
        try {
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
            $decoded_id = $this->real_id;
            // if (!empty(User::where('username', $this->email_Responsibilty)->first()->email)) {
            //     $email = User::where('username', $this->email_Responsibilty)->first()->email;
                
            //     $url = "http://tokasafe.tokatindung.com:8080/eventReport/hazard_id/detail/$decoded_id";
            //     if (!empty($email)) {
            //         Mail::to($email)->send(new responsibilityAction( $this->responsibility, $this->followup_action, $url));
            //     }
            // }

            session()->flash('success', 'Data Updated Successfully!!');
            $this->emit('Add_action');
            $this->clearFields();
        } catch (\Throwable $th) {
            session()->flash('error', 'something wrong!!');
        }
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
    public function paginationView()
    {
        return 'livewire.pagination';
    }
}
