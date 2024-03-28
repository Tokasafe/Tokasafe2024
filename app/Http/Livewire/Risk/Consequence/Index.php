<?php

namespace App\Http\Livewire\Risk\Consequence;

use App\Models\RiskConsequence;
use Livewire\Component;

class Index extends Component
{
    public $search = '';
    public $name;
    public $description;
    public $IdData;
    protected $listeners = [

        'AddConsequence' => 'render',
        'UpdateConsequence' => 'render',
    ];
    public function render()
    {
        return view('livewire.risk.consequence.index', [
            'Consequence' => RiskConsequence::orderBy('name', 'ASC')->search(trim($this->search))->paginate(5),
        ])->extends('navigation.homebase', ['header' => 'Risk Consequence'])->section('content');
    }
    public function update_Consequence($id)
    {
        $this->emit('Update_Consequence', $id);
    }
    public function delete_Consequence($id)
    {
        $this->IdData = $id;
        $Risk = RiskConsequence::whereId($id)->first();
        $this->name = $Risk->name;
        $this->description = $Risk->description;
    }
    public function deleteFile()
    {
        try {
            RiskConsequence::find($this->IdData)->delete();
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
