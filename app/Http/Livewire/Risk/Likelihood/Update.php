<?php

namespace App\Http\Livewire\Risk\Likelihood;

use App\Models\RiskLikelihood;
use Livewire\Component;

class Update extends Component
{
    public $name;
    public $notes;
    public $data_id;
    public $openModal = '';
    protected $listeners = [

        'Update_Likelihood',
    ];
    public function Update_Likelihood($value)
    {
        if (!is_null($value)) {
            $this->data_id = $value;
            $risk = RiskLikelihood::whereId($this->data_id)->first();
            $this->name = $risk->name;
            $this->notes = $risk->notes;
            $this->openModal = 'modal-open';
        }

    }
    public function render()
    {
        return view('livewire.risk.likelihood.update');
    }
    public function store()
    {

        $this->validate([
            'name' => 'required',
            'notes' => 'required',
        ]);
        try {
            RiskLikelihood::whereId($this->data_id)->update([
                'name' => $this->name,
                'notes' => $this->notes,
            ]);
            $this->clearfilds();
            session()->flash('success', 'Data Updated Successfully!!');
        } catch (\Exception $ex) {
            session()->flash('error', 'Something goes wrong!!');
        }
        $this->emit('UpdateLikelihood');
        $this->openModal = '';
    }
    public function clearfilds()
    {
        $this->name = '';
        $this->notes = '';
    }
    public function outModal()
    {
        $this->openModal = '';
    }
}
