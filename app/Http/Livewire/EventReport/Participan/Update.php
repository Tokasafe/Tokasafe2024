<?php

namespace App\Http\Livewire\EventReport\Participan;

use Livewire\Component;

class Update extends Component
{
    public function render()
    {
        return view('livewire.event-report.participan.update')->extends('livewire.event-report.main.index')->section('EventDetails');
    }
}
