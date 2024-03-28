<?php

namespace App\Http\Livewire\Risk\Likelihood;

use App\Models\RiskLikelihood;
use Livewire\Component;

class Index extends Component
{
    public $search = '';
    public $name;
    public $notes;
    public $IdData;
    protected $listeners = [

        'AddLikelihood' => 'render',
        'UpdateLikelihood' => 'render',
    ];
    public function render()
    {
        return view('livewire.risk.likelihood.index', [
            'Likelihood' => RiskLikelihood::orderBy('name', 'ASC')->search(trim($this->search))->paginate(5),
        ])->extends('navigation.homebase', ['header' => 'Risk Likelihood'])->section('content');
    }
    public function update_Likelihood($id)
    {
        $this->emit('Update_Likelihood', $id);
    }
    public function delete_Likelihood($id)
    {
        $this->IdData = $id;
        $Risk = RiskLikelihood::whereId($id)->first();
        $this->name = $Risk->name;
        $this->notes = $Risk->notes;
    }
    public function deleteFile()
    {
        try {
            RiskLikelihood::find($this->IdData)->delete();
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
