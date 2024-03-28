<?php

namespace App\Http\Livewire\Dasboard\Chart\AllInjury;

use Livewire\Component;

class Index extends Component
{
    public function render()
    {
        return view('livewire.dasboard.chart.all-injury.index')->extends('navigation.homebase',['header' => 'Dashboard'])->section('content');
    }
}
