<?php

namespace App\Http\Livewire\Event\Category;

use App\Imports\EventCategoryImport;
use Livewire\Component;
use App\Models\EventCategory;
use Livewire\WithFileUploads;
use Maatwebsite\Excel\Facades\Excel;

class Create extends Component
{
    use WithFileUploads;
    public $name, $fileImport;
    public function render()
    {
        return view('livewire.event.category.create');
    }
    public function store()
    {

        $this->validate([
            'name' => 'required',
        ]);
        EventCategory::create([
            'name' => $this->name,
        ]);
        $this->emit('AddEventCategory');
        $this->name = null;
        session()->flash('success', 'Company Category has been added!!!');
    }
    public function uploadEventCategories()
    {
        $this->validate(['fileImport' => 'required']);
        Excel::import(new EventCategoryImport, $this->fileImport);
        $this->emit('uploadEventCategory');
        session()->flash('success', "importing file has done!!");
    }
}
