<?php

namespace App\Http\Livewire\EventReport\Document;

use Livewire\Component;
use App\Models\Document;
use Livewire\WithPagination;
use App\Imports\PeopleImport;
use Vinkla\Hashids\Facades\Hashids;
use Maatwebsite\Excel\Facades\Excel;

class Index extends Component
{
    public $ID_Details;
    public $nameData;
    public $filename;
    public $fileImport;
    public $hasID;
    public $delete_id;
    use WithPagination;
    protected $listeners = [
        'AddDoc' => 'render',
        'up_action' => 'render',
    ];
    public function mount($id)
    {
        $this->ID_Details = $id;
    }
    public function render()
    {
        return view('livewire.event-report.document.index',[
            'Document' => Document::where('event_report_id',$this->ID_Details)->paginate(5),
            ])->extends('livewire.event-report.details')->section('eventDetails');
    }
    public function download($id)
    {
        $name = Document::whereId($id)->first()->fileName;
        return response()->download(storage_path('app/public/' . $name));
    }
    public function delete($id)
    {
        $this->delete_id = $id;
        $this->nameData = Document::whereId($id)->first()->fileTitle;
        $this->filename = Document::whereId($id)->first()->fileName;
    }
   
    public function deleteFile()
    {
        try {
            Document::find($this->delete_id)->delete();
            // Storage::delete($this->filename);
            unlink(storage_path('app/public/' . $this->filename));
            session()->flash('success', "Deleted file!!");
        } catch (\Exception $e) {
            session()->flash('error', "Something goes wrong!!");
        }
    }
}
