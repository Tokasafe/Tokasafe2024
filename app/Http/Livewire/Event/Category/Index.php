<?php

namespace App\Http\Livewire\Event\Category;

use App\Models\EventCategory;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;
    public $search = '';
    public $nameData;
    public $IdData;
    protected $listeners = [

        'AddEventCategory' => 'render',
        'UpdateEventCategory' => 'render',
    ];
    public function render()
    {
        return view('livewire.event.category.index', [
            'EventCategory' => EventCategory::search(trim($this->search))->paginate(5),
        ])->extends('navigation.homebase', ['header' => 'Event Category'])->section('content');
    }
    public function update_EventCategory($id)
    {
        $this->emit('UpdateEventCategory', $id);
    }
    public function delete_EventCategory($id)
    {
        $this->IdData = $id;
        $this->nameData = EventCategory::whereId($id)->first()->name;
    }
    public function deleteFile()
    {
        try {
            EventCategory::find($this->IdData)->delete();
            session()->flash('success', "Event Category Deleted Successfully!!");
        } catch (\Exception $e) {
            session()->flash('error', "Something goes wrong!!");
        }
    }
    public function paginationView()
    {
        return 'livewire.pagination';
    }
}
