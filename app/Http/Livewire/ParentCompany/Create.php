<?php

namespace App\Http\Livewire\ParentCompany;

use App\Models\CompanyCategory;
use Livewire\Component;

class Create extends Component
{
    public $name;
    public function render()
    {
        return view('livewire.parent-company.create');
    }
    public function store()
    {

        $this->validate([
            'name' => 'required',
        ]);
        CompanyCategory::create([
            'name' => $this->name,
        ]);
        $this->emit('AddPC');
        $this->name = null;
        session()->flash('success', 'Company Category has been added!!!');
    }
}
