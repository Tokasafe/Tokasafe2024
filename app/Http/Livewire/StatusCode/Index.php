<?php

namespace App\Http\Livewire\StatusCode;

use App\Models\StatusCode;
use Livewire\Component;

class Index extends Component
{
    public $name;
    public $status_id;
    protected $listeners = [
        'addStatusCode' => 'render',
        'updateStatusCode' => 'render',
    ];
    public function render()
    {
        return view('livewire.status-code.index', [
            'StatusCode' => StatusCode::paginate(5),
        ])->extends('navigation.homebase', ['header' => 'Status Code'])->section('content');
    }
    public function update($id)
    {
        $this->emit('update_StatusCode', $id);
    }
    public function delete($id)
    {
        $this->status_id = $id;
        $this->name = StatusCode::whereId($id)->first()->name;
    }
    public function deleteFile()
    {
        try {
            StatusCode::find($this->status_id)->delete();
            session()->flash('success', "File Deleted Successfully!!");
        } catch (\Exception $e) {
            session()->flash('error', "Something goes wrong!!");
        }
    }
}
