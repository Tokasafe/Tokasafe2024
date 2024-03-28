<?php

namespace App\Http\Livewire\Risk\Assessment;

use App\Models\RiskAssessment;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;
    public $name;
    public $notes;
    public $IdData;
    protected $listeners = [

        'AddAssessment' => 'render',
        'UpdateAssessment' => 'render',
    ];
    public function render()
    {
        return view('livewire.risk.assessment.index', [
            'Assessment' => RiskAssessment::paginate(5),
        ])->extends('navigation.homebase', ['header' => 'Risk Assessment'])->section('content');
    }
    public function update_Assessment($id)
    {
        $this->emit('Update_Assessment', $id);
    }
    public function delete_Assessment($id)
    {
        $this->IdData = $id;
        $Risk = RiskAssessment::whereId($id)->first();
        $this->name = $Risk->name;
        $this->notes = $Risk->notes;
    }
    public function deleteFile()
    {
        try {
            RiskAssessment::find($this->IdData)->delete();
            session()->flash('success', "Data Deleted Successfully!!");
        } catch (\Exception $e) {
            session()->flash('error', "Something goes wrong!!");
        }
    }
    public function paginationView()
    {
        return 'livewire.pagination';
    }
}
