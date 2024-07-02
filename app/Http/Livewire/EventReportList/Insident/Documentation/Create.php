<?php

namespace App\Http\Livewire\EventReportList\Insident\Documentation;

use Livewire\Component;
use App\Models\PanelIncident;
use Livewire\WithFileUploads;
use App\Models\DocumentationIncident;

class Create extends Component
{
    use WithFileUploads;
    public $fileTitle, $fileName, $incident_id,$IncidentClose;
    public function mount($id)
    {
       
        $this->incident_id =  $id;
        $close = PanelIncident::where('incident_report_id',$this->incident_id)->first()->WorkflowStep->name;
        if ($close ==='Closed' || $close ==='Cancelled') {
            $this->IncidentClose = $close;
        }
    }
    public function render()
    {
        return view('livewire.event-report-list.insident.documentation.create');
    }
    public function store_document()
    {
        $dataValid = $this->validate([
            'fileTitle' => 'required',
            'incident_id' => 'required',
            'fileName' => 'required|mimes:jpg,jpeg,png,svg,gif,xlsx,pdf,docx',
        ]);
        $file_name = $this->fileName->getClientOriginalName();
        $this->fileName->storeAs('public/documents', $file_name);
        $dataValid['fileName'] = $file_name;
        session()->flash('success', 'File uploaded.');
        DocumentationIncident::create($dataValid);
        $this->emit('AddDocIncident');

    }
}
