<?php

namespace App\Http\Livewire\EventReportList\HazardId\Document;

use Livewire\Component;
use App\Models\Document;
use App\Models\PanelHazardId;
use Livewire\WithFileUploads;

class Create extends Component
{
    use WithFileUploads;
    public $fileTitle, $fileName, $event_report_id,$hazardClose;
    public function mount($id)
    {
        $eventReportId = $id;
        $this->event_report_id =  $eventReportId;
        $close = PanelHazardId::where('hazard_id',$this->event_report_id)->first()->WorkflowStep->name;
        if ($close ==='Closed' || $close ==='Cancelled') {
            $this->hazardClose = $close;
        }
    }
    public function render()
    {
        return view('livewire.event-report-list.hazard-id.document.create');
    }
    public function store_document()
    {
        $dataValid = $this->validate([
            'fileTitle' => 'required',
            'event_report_id' => 'required',
            'fileName' => 'required|mimes:jpg,jpeg,png,svg,gif,xlsx,pdf,docx',
        ]);
        $file_name = $this->fileName->getClientOriginalName();
        $this->fileName->storeAs('public/documents', $file_name);
        $dataValid['fileName'] = $file_name;
        session()->flash('success', 'File uploaded.');
        Document::create($dataValid);
        $this->emit('AddDoc');

    }
}
