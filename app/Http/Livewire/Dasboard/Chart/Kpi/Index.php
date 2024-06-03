<?php

namespace App\Http\Livewire\Dasboard\Chart\Kpi;

use App\Models\HazardId;
use Livewire\Component;

class Index extends Component
{
    public $hazard_count;
    public function render()
    {
        $this->hazard_count = HazardId::count();
        return view('livewire.dasboard.chart.kpi.index');
    }
}
