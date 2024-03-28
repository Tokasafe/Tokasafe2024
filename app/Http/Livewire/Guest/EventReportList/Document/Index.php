<?php

namespace App\Http\Livewire\Guest\EventReportList\Document;

use Livewire\Component;
use App\Models\Document;
use Livewire\WithPagination;
use App\Models\PanelHazardId;

class Index extends Component
{
    public $ID_Details;
    public $nameData;
    public $filename;
    public $fileImport;
    public $hazardClose;
    public $delete_id;
    use WithPagination;
    protected $listeners = [
        'AddDoc' => 'render',
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
        return view('livewire.guest.event-report-list.document.index',[
            'Document' => Document::where('event_report_id',$this->ID_Details)->paginate(5),
        ]);
    }
}
