<?php

namespace App\Http\Livewire\Event\Site;

use App\Models\EventSite;
use Livewire\Component;

class Update extends Component
{
    public $data;
    public $name;
    public $data_id;
    public $openModal = '';
    protected $listeners = [

        'UpdateEventSite',
    ];
    public function UpdateEventSite($value)
    {

        if (!is_null($value)) {
            $this->data_id = $value;
            $this->name = EventSite::where('id', $this->data_id)->first()->name;
            $this->openModal = 'modal-open';
        }
    }
    public function render()
    {
        return view('livewire.event.site.update');
    }
    public function store()
    {

        $this->validate([
            'name' => 'required',
        ]);
        try {
            EventSite::whereId($this->data_id)->update([
                'name' => $this->name,
            ]);
            session()->flash('success', 'Data Updated Successfully!!');
            $this->name = null;
        } catch (\Exception $ex) {
            session()->flash('success', 'Something goes wrong!!');
        }
        $this->emit('UpdateSite');
        $this->openModal = '';
    }

    public function outModal()
    {
        $this->openModal = '';
    }
}
