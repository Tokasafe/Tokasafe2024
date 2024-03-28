<?php

namespace App\Http\Livewire\Event\Category;

use App\Models\EventCategory;
use Livewire\Component;

class Update extends Component
{
    public $data;
    public $name;
    public $data_id;
    public $openModal = '';
    protected $listeners = [

        'UpdateEventCategory',
    ];
    public function UpdateEventCategory($value)
    {

        if (!is_null($value)) {
            $this->data_id = $value;
            $this->name = EventCategory::where('id', $this->data_id)->first()->name;

            $this->openModal = 'modal-open';
        }

    }
    public function render()
    {
        return view('livewire.event.category.update');
    }

    public function store()
    {

        $this->validate([
            'name' => 'required',
        ]);
        try {
            EventCategory::whereId($this->data_id)->update([
                'name' => $this->name,
            ]);
            session()->flash('success', 'Data Updated Successfully!!');
            $this->name = null;
        } catch (\Exception $ex) {
            session()->flash('success', 'Something goes wrong!!');
        }
        $this->emit('UpdateEventCategory');
        $this->openModal = '';
    }

    public function outModal()
    {
        $this->openModal = '';
    }
}
