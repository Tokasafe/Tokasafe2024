<?php

namespace App\Http\Livewire\Event\Site;

use App\Models\EventSite;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;
    public $search = '';
    public $nameData;
    public $IdData;
    protected $listeners = [

        'AddSite' => 'render',
        'UpdateSite' => 'render',
    ];
    public function render()
    {
        return view('livewire.event.site.index', [
            'EventSite' => EventSite::search(trim($this->search))->paginate(5),
        ])->extends('navigation.homebase', ['header' => 'Event Site'])->section('content');
    }

    public function update_EventSite($id)
    {
        $this->emit('UpdateEventSite', $id);
    }
    public function delete_EventSite($id)
    {
        $this->IdData = $id;
        $this->nameData = EventSite::whereId($id)->first()->name;
    }
    public function deleteFile()
    {
        try {
            EventSite::find($this->IdData)->delete();
            session()->flash('success', "Event Site Deleted Successfully!!");
        } catch (\Exception $e) {
            session()->flash('error', "Something goes wrong!!");
        }
    }
    public function paginationView()
    {
        return 'livewire.pagination';
    }
}
