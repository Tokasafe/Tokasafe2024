<?php

namespace App\Http\Livewire\Time;

use Carbon\Carbon;
use Livewire\Component;

class Index extends Component
{
    public $jam,$menit,$detik;
    public function render()
    {
        $this->jam = Carbon::now(+8)->hour;
        $this->menit = Carbon::now(+8)->minute;
        $this->detik = Carbon::now(+8)->second;
        return view('livewire.time.index');
    }
}
