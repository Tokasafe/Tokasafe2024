<?php

namespace App\Http\Livewire\Guest\EventReportList\Action;

use Livewire\Component;
use App\Models\EventAction;
use Livewire\WithPagination;
use App\Models\PanelHazardId;

class Index extends Component
{
    use WithPagination;
    public $ID_Details;
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

    }
    
    public function render()
    {
        return view('livewire.guest.event-report-list.action.index',[
            'EventAction' => EventAction::with(['People'])->where('event_hzd_id',$this->ID_Details)->paginate(5),
        ]);
    }
}
