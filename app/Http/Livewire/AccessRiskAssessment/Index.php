<?php

namespace App\Http\Livewire\AccessRiskAssessment;

use App\Models\AccessRiskAssessment;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;
    public $IdData;
    public $search = '';
    public $nameData;
    protected $listeners = [

        'AddRisk' => 'render',
        'UpdateRiskUpdate' => 'render',
    ];
    public function render()
    {
        return view('livewire.access-risk-assessment.index', [
            'Access' => AccessRiskAssessment::with('EventType')->paginate(5),
        ])->extends('navigation.homebase', ['header' => 'Access Risk Assessment'])->section('content');
    }
    public function update_company($id)
    {
        $this->emit('AccessRiskUpdate', $id);
    }
    public function deleteFiles($id)
    {
        $this->IdData = $id;
        $this->nameData = AccessRiskAssessment::whereId($id)->first()->name;
    }
    public function deleteFile()
    {
        try {
            AccessRiskAssessment::find($this->IdData)->delete();
            session()->flash('success', "Company Deleted Successfully!!");
        } catch (\Exception $e) {
            session()->flash('error', "Something goes wrong!!");
        }
    }
    public function paginationView()
    {
        return 'livewire.pagination';
    }
}
