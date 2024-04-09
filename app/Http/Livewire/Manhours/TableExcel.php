<?php

namespace App\Http\Livewire\Manhours;

use Livewire\Component;
use App\Models\ManhoursRegister;

class TableExcel extends Component
{
    public function render()
    {
        return view('livewire.manhours.table-excel',[
           "ManhoursRegister"=> ManhoursRegister::orderBy('date', 'asc')->orderBy('company', 'asc')->get()
        ])->extends('navigation.guest.guestbase')->section('contentUser');;
    }
}
