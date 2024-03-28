<?php

namespace App\Http\Livewire\ResponsibleRole;

use App\Models\ResponsibleRole;
use Livewire\Component;

class Index extends Component
{
    public $name;
    public $R_role;
    protected $listeners = [

        'R_role' => 'render',
        'UpdateR_role' => 'render',
    ];
    public function render()
    {
        return view('livewire.responsible-role.index', [
            'ResponsibleRole' => ResponsibleRole::paginate(5),
        ])->extends('navigation.homebase', ['header' => 'Responsible Role'])->section('content');
    }
    public function update($id)
    {
        $this->emit('updateResponsibleRole', $id);
    }

    public function delete($id)
    {
        $this->R_role = $id;
        $this->name = ResponsibleRole::where('id', $id)->first()->name;
    }
    public function deleteFile()
    {
        try {
            ResponsibleRole::find($this->R_role)->delete();
            session()->flash('success', "File Deleted Successfully!!");
        } catch (\Exception $e) {
            session()->flash('error', "Something goes wrong!!");
        }
    }

}
