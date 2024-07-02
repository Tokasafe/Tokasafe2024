<?php

namespace App\Http\Livewire\EventReportList\Insident\Documentation;

use App\Models\DocumentationIncident;
use App\Models\PanelIncident;
use Livewire\Component;

class Index extends Component
{
    public $ID_Details,$IncidentClose,$nameData,$filename,$modalDelete='modal',$delete_id;
    protected $listeners = [
        'AddDocIncident' => 'render',
    ];
    public function mount($id)
    {
        $this->ID_Details = $id;
       
        $close = PanelIncident::where('incident_report_id', $this->ID_Details)->first()->WorkflowStep->name;
        if ($close ==='Closed' || $close ==='Cancelled') {
            $this->IncidentClose = $close;
        }
    }
    public function render()
    {
        return view('livewire.event-report-list.insident.documentation.index',[
            'Document' => DocumentationIncident::where('incident_id',$this->ID_Details)->paginate(5),
        ]);
    }
    public function download($id)
    {
        $name = DocumentationIncident::whereId($id)->first()->fileName;
        return response()->download(storage_path('app/public/documents/' . $name));
    }
    public function delete($id)
    {
        $this->delete_id = $id;
        $this->nameData = DocumentationIncident::whereId($id)->first()->fileTitle;
        $this->filename = DocumentationIncident::whereId($id)->first()->fileName;
    }
    public function paginationView()
    {
        return 'livewire.pagination';
    }
   
    public function deleteFile()
    {
        try {
            DocumentationIncident::find($this->delete_id)->delete();
            // Storage::delete($this->filename);
            unlink(storage_path('app/public/documents/' . $this->filename));
            session()->flash('success', "Deleted file!!");
        } catch (\Exception $e) {
            session()->flash('error', "Something goes wrong!!");
        }
    }
}
