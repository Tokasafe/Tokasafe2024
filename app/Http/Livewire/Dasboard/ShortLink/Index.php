<?php

namespace App\Http\Livewire\Dasboard\ShortLink;

use Livewire\Component;

class Index extends Component
{
    public function render()
    {
        return view('livewire.dasboard.short-link.index');
    }
    public function addTodo()
    {
        $this->emit('OpenModalHzd', 'modal-open');
    }
}
