<?php

namespace App\Http\Livewire\EventReport\Document;

use Livewire\Component;
use App\Models\Document;
use Livewire\WithFileUploads;
use Vinkla\Hashids\Facades\Hashids;

class Create extends Component
{
    use WithFileUploads;
    public $fileTitle, $fileName, $event_report_id;
    public function mount($id)
    {
        $eventReportId = $id;
        $this->event_report_id =  $eventReportId;

    }
    public function render()
    {
        return view('livewire.event-report.document.create');
    }
    public function store_document()
    {
        $dataValid = $this->validate([
            'fileTitle' => 'required',
            'event_report_id' => 'required',
            'fileName' => 'required|mimes:jpg,jpeg,png,svg,gif,xlsx,pdf,docx|max:2048',
        ]);
        $dataValid['fileName'] = $this->fileName->store('documents', 'public');
        session()->flash('success', 'File uploaded.');
        Document::create($dataValid);
        $this->emit('AddDoc');

    }
}
