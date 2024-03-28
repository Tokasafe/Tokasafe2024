<?php

namespace App\Http\Livewire\EventReportList\HazardId\Action;

use App\Models\People;
use Livewire\Component;
use App\Models\EventAction;

class Update extends Component
{
    public $data_id;
    public $modalOpenEvent = '';
    public $modalOpen = '';

    public $report = '';
    public $followup_action;
    public $actionee_comments = '';
    public $action_condition = '';
    public $due_date = '';
    public $competed = '';
    public $tanggal_mulai = '';
    public $tanggal_selesai = '';
    public $search_reportBy = '';
    public $responsibility;
    public $responsibility_id;
    protected $listeners = [

        'EventActionUp',
    ];
    public function EventActionUp($value)
    {
        if (!is_null($value)) {

            $this->data_id = $value;
            $EventAction = EventAction::where('id', $this->data_id)->first();
            $this->report = $EventAction->report;
            $this->followup_action = $EventAction->followup_action;
            $this->actionee_comments = $EventAction->actionee_comments;
            $this->action_condition = $EventAction->action_condition;

            if (!empty($EventAction->due_date)) {
                $this->due_date = date('d-m-Y', strtotime($EventAction->due_date));
            } else {
                $this->due_date = '';
            }
            if (!empty($EventAction->competed)) {
                $this->competed = date('d-m-Y', strtotime($EventAction->competed));
            } else {
                $this->competed = '';
            }

            $this->responsibility = $EventAction->People->lookup_name;
            $this->responsibility_id = $EventAction->responsibility;

            $this->modalOpenEvent = 'modal-open';
        }
    }
    public function render()
    {
        return view('livewire.event-report-list.hazard-id.action.update', [
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
            $this->responsibility = $reportBy->lookup_name;
            $this->responsibility_id = $reportBy->id;
            $this->reportByClickClose();
        }
    }
    public function reportByClickClose()
    {

        $this->modalOpen = '';
    }
    public function outModal()
    {
        $this->modalOpenEvent = '';
    }

    public function store()
    {
        if (!empty($this->due_date)) {
            $this->tanggal_mulai = date('Y-m-d', strtotime($this->due_date));
        } else {
            $this->tanggal_mulai = null;
        }
        if (!empty($this->competed)) {
            $this->tanggal_selesai = date('Y-m-d', strtotime($this->competed));
        } else {
            $this->tanggal_selesai = null;
        }

        try {
            EventAction::whereId($this->data_id)->update([
                'report' => $this->report,
                'followup_action' => $this->followup_action,
                'actionee_comments' => $this->actionee_comments,
                'action_condition' => $this->action_condition,
                'due_date' => $this->tanggal_mulai,
                'competed' => $this->tanggal_selesai,
                'responsibility' => $this->responsibility_id,
            ]);
            session()->flash('success', 'Data Updated Successfully!!');
            $this->emit('up_action');
            $this->outModal();
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
}
