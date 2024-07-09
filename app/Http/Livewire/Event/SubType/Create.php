<?php

namespace App\Http\Livewire\Event\SubType;

use Livewire\Component;
use App\Models\EventType;
use App\Models\EventSubType;
use App\Imports\EventSubTypeImport;
use Livewire\WithFileUploads;
use Maatwebsite\Excel\Facades\Excel;

class Create extends Component
{
    use WithFileUploads;
    public $name,$fileImport;
    public $eventType_id;
    public function render()
    {
        return view('livewire.event.sub-type.create', [
            'EventType' => EventType::get(),
        ]);
    }
    public function store()
    {

        $this->validate([
            'eventType_id' => 'required',
            'name' => 'required',
        ]);

        EventSubType::create([
            'name' => $this->name,
            'eventType_id' => $this->eventType_id,
        ]);
        session()->flash('success', 'Data added Successfully!!');
        $this->clearFields();
        $this->emit('AddEventSubType');
    }

    public function uploadEventSubTypes()
    {
        $this->validate(['fileImport' => 'required']);
        Excel::import(new EventSubTypeImport, $this->fileImport);
        $this->emit('uploadEventSubType');
        session()->flash('success', "importing file has done!!");
    }
    public function clearFields()
    {
        // $this->eventType_id = '';
        $this->name = '';
    }
}
