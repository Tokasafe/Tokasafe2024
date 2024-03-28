<?php

namespace App\Http\Livewire\EventReportList\HazardId\Document;

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
        return view('livewire.event-report-list.hazard-id.document.index',[
            'Document' => Document::where('event_report_id',$this->ID_Details)->paginate(5),
        ]);
    }
    public function download($id)
    {
        $name = Document::whereId($id)->first()->fileName;
        return response()->download(storage_path('app/public/documents/' . $name));
    }
    public function delete($id)
    {
        $this->delete_id = $id;
        $this->nameData = Document::whereId($id)->first()->fileTitle;
        $this->filename = Document::whereId($id)->first()->fileName;
    }
    public function paginationView()
    {
        return 'livewire.pagination';
    }
   
    public function deleteFile()
    {
        try {
            Document::find($this->delete_id)->delete();
            // Storage::delete($this->filename);
            unlink(storage_path('app/public/documents/' . $this->filename));
            session()->flash('success', "Deleted file!!");
        } catch (\Exception $e) {
            session()->flash('error', "Something goes wrong!!");
        }
    }
}
