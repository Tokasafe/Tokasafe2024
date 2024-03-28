<?php

namespace App\Http\Livewire\ResponsibleRole;

use App\Models\ResponsibleRole;
use Livewire\Component;

class Update extends Component
{
    public $data_id;
    public $name;
    public $openModal = '';
    protected $listeners = [

        'updateResponsibleRole',
    ];
    public function updateResponsibleRole($value)
    {
        if (!is_null($value)) {
            $this->data_id = $value;
            $R_role = ResponsibleRole::where('id', $this->data_id)->first();
            $this->name = $R_role->name;
            $this->openModal = 'modal-open';
        }
    }
    public function render()
    {
        return view('livewire.responsible-role.update');
    }
    public function store()
    {
        $this->validate([
            'name' => 'required',
        ]);
        try {
            ResponsibleRole::whereId($this->data_id)->update([
                'name' => $this->name,
            ]);
            session()->flash('success', 'Data Updated Successfully!!');
            $this->name = null;
        } catch (\Exception $ex) {
            session()->flash('success', 'Something goes wrong!!');
        }
        $this->emit('UpdateR_role');
        $this->openModal = '';
    }
    public function closeModal()
    {
        $this->openModal = '';
    }
}
