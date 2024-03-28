<?php

namespace App\Http\Livewire\EventReport\Participan;

use App\Models\PihakTerlibat;
use Livewire\Component;
use Livewire\WithPagination;
use Vinkla\Hashids\Facades\Hashids;

class Index extends Component
{
    use WithPagination;
    public $ID_Details;
    public $name;
    public $id_data;
    protected $listeners = [

        'Add_Keterlibatan' => 'render',
        'UpdateKeterlibatan' => 'render',
    ];
    public function render()
    {
        $decoded_id = Hashids::decode($this->ID_Details)[0];

        return view('livewire.event-report.participan.index', [
            'PihakTerlibat' => PihakTerlibat::where('event_report_id', $decoded_id)->paginate(5),
        ])->extends('livewire.event-report.details')->section('eventDetails');
    }
    public function mount($id)
    {
        $this->ID_Details = $id;
    }

    public function deletePihak($id)
    {
        $this->id_data = $id;
        $this->name = PihakTerlibat::whereId($id)->first()->name;
    }
    public function deleteFile()
    {
        try {
            PihakTerlibat::find($this->id_data)->delete();
            session()->flash('success', "Deleted Successfully!!");
        } catch (\Exception $e) {
            session()->flash('error', "Something goes wrong!!");
        }
    }
    public function paginationView()
    {
        return 'livewire.pagination';
    }
}
