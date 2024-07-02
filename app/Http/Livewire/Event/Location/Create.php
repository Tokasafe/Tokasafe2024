<?php

namespace App\Http\Livewire\Event\Location;

use Livewire\Component;
use App\Models\EventLocation;
use App\Imports\LocationImport;
use Livewire\WithFileUploads;
use Maatwebsite\Excel\Facades\Excel;

class Create extends Component
{
    use WithFileUploads;
    public $name,$fileImport;
    public function render()
    {
        return view('livewire.event.location.create');
    }
    public function store()
    {

        $this->validate([
            'name' => 'required',
        ]);
        EventLocation::create([
            'name' => $this->name,
        ]);
        $this->emit('AddLocationEvent');
        $this->name = null;
        session()->flash('success', 'Company Category has been added!!!');
    }
    public function uploadLocation(){
        $this->validate(['fileImport' => 'required']);
        Excel::import(new LocationImport,$this->fileImport);
        $this->emit('locationImport');
        session()->flash('success', "importing file has done!!");
    }
}
