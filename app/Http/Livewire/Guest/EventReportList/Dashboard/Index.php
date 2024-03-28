<?php

namespace App\Http\Livewire\Guest\EventReportList\Dashboard;

use Livewire\Component;

class Index extends Component
{
    public function render()
    {
        return view('livewire.guest.event-report-list.dashboard.index',[
            
        ])->extends( ['header' => 'Dashboard']);
    }
}
