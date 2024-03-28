<?php

namespace App\Http\Livewire\ResponsibleRole;

use App\Models\ResponsibleRole;
use Livewire\Component;

class Create extends Component
{
    public $name;
    public function render()
    {
        return view('livewire.responsible-role.create');
    }
    public function store()
    {
        $this->validate([
            'name' => 'required',
        ]);
        try {
            ResponsibleRole::create([
                'name' => $this->name,
            ]);
            session()->flash('success', 'Data added Successfully!!');
            $this->emit('R_role');
            $this->name = '';
        } catch (\Throwable $th) {
            session()->flash('success', 'Something goes wrong!!');
        }
    }
}
