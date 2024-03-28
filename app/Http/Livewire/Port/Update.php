<?php

namespace App\Http\Livewire\Port;

use App\Models\Port;
use Livewire\Component;

class Update extends Component
{
    public $code;
    public $name;
    public $data_id;
    public $openModal = '';
    protected $listeners = [

        'DataUpdate',
    ];
    public function DataUpdate($value)
    {
        if (!is_null($value)) {
            $this->data_id = $value;
            $role = Port::where('id', $this->data_id)->first();

            $this->openModal = 'modal-open';
        }
    }
    public function render()
    {
        return view('livewire.port.update');
    }
    public function store()
    {

        $this->validate([
            'name' => 'required',
            'code' => 'required',
        ]);
        try {
            Port::whereId($this->data_id)->update([
                'name' => $this->name,
                'code' => $this->code,
            ]);
            session()->flash('success', 'Data Updated Successfully!!');
            $this->name = null;
        } catch (\Exception $ex) {
            session()->flash('success', 'Something goes wrong!!');
        }
        $this->emit('UpdateRole');
        $this->openModal = '';
    }
    public function clearFilds()
    {
        $this->name = '';
        $this->code = '';
    }
    public function outModal()
    {
        $this->openModal = '';
    }
}
