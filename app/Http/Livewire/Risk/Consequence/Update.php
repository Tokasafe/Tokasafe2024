<?php

namespace App\Http\Livewire\Risk\Consequence;

use App\Models\RiskConsequence;
use Livewire\Component;

class Update extends Component
{

    public $name;
    public $description;
    public $data_id;
    public $openModal = '';
    protected $listeners = [

        'Update_Consequence',
    ];
    public function Update_Consequence($value)
    {
        if (!is_null($value)) {
            $this->data_id = $value;
            $risk = RiskConsequence::whereId($this->data_id)->first();
            $this->name = $risk->name;
            $this->description = $risk->description;
            $this->openModal = 'modal-open';
        }

    }
    public function render()
    {
        return view('livewire.risk.consequence.update');
    }
    public function store()
    {

        $this->validate([
            'name' => 'required',
            'description' => 'required',
        ]);
        try {
            RiskConsequence::whereId($this->data_id)->update([
                'name' => $this->name,
                'description' => $this->description,
            ]);
            $this->clearfilds();
            session()->flash('success', 'Data Updated Successfully!!');
        } catch (\Exception $ex) {
            session()->flash('error', 'Something goes wrong!!');
        }
        $this->emit('UpdateConsequence');
        $this->openModal = '';
    }
    public function clearfilds()
    {
        $this->name = '';
        $this->description = '';
    }
    public function outModal()
    {
        $this->openModal = '';
    }
}
