<?php

namespace App\Http\Livewire\Risk\Assessment;

use App\Models\RiskAssessment;
use Livewire\Component;

class Update extends Component
{
    public $name;
    public $notes;
    public $investigation_req;
    public $reporting_obligation;
    public $data_id;
    public $openModal = '';
    protected $listeners = [

        'Update_Assessment',
    ];
    public function Update_Assessment($value)
    {
        if (!is_null($value)) {
            $this->data_id = $value;
            $risk = RiskAssessment::whereId($this->data_id)->first();
            $this->name = $risk->name;
            $this->notes = $risk->notes;
            $this->investigation_req = $risk->investigation_req;
            $this->reporting_obligation = $risk->reporting_obligation;
            $this->openModal = 'modal-open';
        }

    }
    public function render()
    {
        return view('livewire.risk.assessment.update');
    }
    public function store()
    {

        $this->validate([
            'name' => 'required',
            'notes' => 'required',
            'investigation_req' => 'required',
            'reporting_obligation' => 'required',
        ]);
        try {
            RiskAssessment::whereId($this->data_id)->update([
                'name' => $this->name,
                'notes' => $this->notes,
                'investigation_req' => $this->investigation_req,
                'reporting_obligation' => $this->reporting_obligation,
            ]);
            $this->clearfilds();
            session()->flash('success', 'Data Updated Successfully!!');
        } catch (\Exception $ex) {
            session()->flash('error', 'Something goes wrong!!');
        }
        $this->emit('UpdateAssessment');
        $this->openModal = '';
    }
    public function clearfilds()
    {
        $this->name = '';
        $this->notes = '';
        $this->investigation_req = '';
        $this->reporting_obligation = '';
    }
    public function outModal()
    {
        $this->openModal = '';
    }
}
