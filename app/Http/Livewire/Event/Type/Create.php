<?php

namespace App\Http\Livewire\Event\Type;

use Livewire\Component;
use App\Models\EventType;
use App\Models\EventCategory;
use App\Imports\EventTypeImport;
use Livewire\WithFileUploads;
use Maatwebsite\Excel\Facades\Excel;

class Create extends Component
{
    public $name,$fileImport;
    use WithFileUploads;
    public $eventCategory_id;
    public function render()
    {
        return view('livewire.event.type.create', [
            'EventCategory' => EventCategory::get(),
        ]);
    }
    public function store()
    {

        $this->validate([
            'eventCategory_id' => 'required',
            'name' => 'required',
        ]);

        EventType::create([
            'name' => $this->name,
            'eventCategory_id' => $this->eventCategory_id,
        ]);
        session()->flash('success', 'Data added Successfully!!');
        $this->clearFields();
        $this->emit('AddEventType');
    }

    public function uploadEventTypes()
    {
        $this->validate(['fileImport' => 'required']);
        Excel::import(new EventTypeImport, $this->fileImport);
        $this->emit('uploadEventType');
        session()->flash('success', "importing file has done!!");
    }
    public function clearFields()
    {
        // $this->eventCategory_id = '';
        $this->name = '';
    }
}
