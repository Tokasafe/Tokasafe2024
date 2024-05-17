<?php

namespace App\Http\Livewire\EventReportList\Insident;

use App\Models\IncidentReport;
use App\Models\PanelIncident;
use Livewire\Component;

class Index extends Component
{
    public $data_id,$reference,$documentation;
    protected $listeners = [

        'IncidentTable' => 'render',
    ];
    public function render()
    {
        return view('livewire.event-report-list.insident.index',[
            'Incident'=>PanelIncident::with(['Incident.eventType','Incident.eventSubType','Incident.workgroup.CompanyLevel.BussinessUnit','Incident.repportBy','Incident.repportTo','WorkflowStep.StatusCode'])->paginate(100, ['*'], 'IncidentPage'),
        ])->extends('navigation.homebase', ['header' => 'Incident report'])->section('content');
    }
    public function delete($id)
    {
       
        $this->data_id = $id;
        $this->reference = IncidentReport::whereId($id)->first()->reference;
        $this->documentation = IncidentReport::whereId($id)->first()->documentation;
    }
    public function deleteFile()
    {
        try {
           
            IncidentReport::find($this->data_id)->delete();
            if ($this->documentation) {
                unlink(storage_path('app/public/documents/' . $this->documentation));
            }
            session()->flash('success', "Hazard Report Deleted Successfully!!");
        } catch (\Exception $e) {
            session()->flash('error', "Something goes wrong!!");
        }
    }
}
