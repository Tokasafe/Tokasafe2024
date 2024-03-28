<?php

namespace App\Http\Livewire\StatusCode;

use App\Models\StatusCode;
use Livewire\Component;

class Update extends Component
{
    public $data_id;
    public $name;
    public $openModal = '';
    protected $listeners = [

        'update_StatusCode',
    ];
    public function update_StatusCode($value)
    {
        if (!is_null($value)) {
            $this->data_id = $value;
            $s_code = StatusCode::whereId($this->data_id)->first();
            $this->name = $s_code->name;
            $this->openModal = 'modal-open';
        }
    }
    public function render()
    {
        return view('livewire.status-code.update');
    }
    public function store()
    {
        $this->validate([
            'name' => 'required',
        ]);
        try {
            StatusCode::whereId($this->data_id)->update([
                'name' => $this->name,
            ]);
            session()->flash('success', 'Data Updated Successfully!!');
            $this->name = null;
        } catch (\Exception $ex) {
            session()->flash('success', 'Something goes wrong!!');
        }
        $this->emit('updateStatusCode');
        $this->openModal = '';
    }
    public function closeModal()
    {
        $this->openModal = '';
    }
}
