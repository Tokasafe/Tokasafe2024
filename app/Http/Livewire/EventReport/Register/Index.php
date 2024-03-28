<?php

namespace App\Http\Livewire\EventReport\Register;

use App\Models\EventCategory;
use App\Models\EventReport;
use App\Models\EventSubType;
use App\Models\EventType;
use App\Models\StatusEvent;
use Livewire\Component;
use Livewire\WithPagination;
use Vinkla\Hashids\Facades\Hashids;

class Index extends Component
{
    use WithPagination;
    public $nameData;
    public $IdData;
    public $EventType_id;
    public $dateRange = '';
    public $searchEventCategory = '';
    public $searchEventType = '';
    public $searchEventSubType = '';
    public $tglMulai = '';
    public $endDate = '';
    public $range;
    public $risk = [];
    public $EventSubType = [];
    public $EventType = [];
    protected $listeners = [
        'TglMulai',
        'TglAkhir',
        'PanelTime' => 'render',
        'AddEventReport' => 'render',
        'UpdateEventReport' => 'render',
    ];
    public function TglMulai($value)
    {
        if (!is_null($value)) {
            $this->tglMulai = date('Y-m-d', strtotime('+1 month', strtotime($value)));

        }
    }
    public function TglAkhir($value)
    {
        if (!is_null($value)) {

            $this->endDate = date('Y-m-d', strtotime('+1 month', strtotime($value)));

        }
    }
    public function render()
    {
        if (empty($this->dateRange)) {
            if (!empty(EventReport::orderby('tgl_kejadian', 'asc')->first()->tgl_kejadian)) {
                $this->tglMulai = EventReport::orderby('tgl_kejadian', 'asc')->first()->tgl_kejadian;
                $this->endDate = EventReport::orderby('tgl_kejadian', 'desc')->first()->tgl_kejadian;
            }
        }

        if (!empty($this->searchEventCategory)) {

            $this->EventType = EventType::where('eventCategory_id', $this->searchEventCategory)->get();
            $this->EventType_id = EventType::where('eventCategory_id', $this->searchEventCategory)->select('id')->get('id');

            if (!empty($this->EventType_id)) {

                if (!empty($this->searchEventType)) {
                    $this->EventSubType = EventSubType::where('eventType_id', $this->searchEventType)->get();
                } else {
                    $this->EventSubType = EventSubType::whereIn('eventType_id', $this->EventType_id)->get();
                }
            }

        } else {
            $this->EventType = EventType::get();
        }
        if (empty($this->searchEventCategory)) {
            if (!empty($this->searchEventType)) {
                $this->EventSubType = EventSubType::where('eventType_id', $this->searchEventType)->get();
            } else {
                $this->EventSubType = EventSubType::get();

            }
        }
        return view('livewire.event-report.register.index', [
            'StatusEvent' => StatusEvent::with(
                [
                    'EventReport.EventType',
                    'EventReport.EventSubType',
                    'EventReport.Workgroup.CompanyLevel.BussinessUnit',
                    'EventReport.ActualOutcome',
                    'EventStatus2.StatusCode',
                ])

                ->searchEventType(trim($this->searchEventType))
                ->searchEventSubType(trim($this->searchEventSubType))
                ->dateRange([trim($this->tglMulai), trim($this->endDate)])->paginate(10),
            'EventCategory' => EventCategory::get(),
        ])->extends('navigation.homebase', ['header' => 'Event Register'])->section('content');
    }
    public function delete_EventReport($id)
    {

        $this->IdData = $id;
        $this->nameData = Hashids::encode($id);
        // $this->nameData = EventReport::whereId($id)->first()->hashid;
    }
    public function deleteFile()
    {
        try {
            EventReport::find($this->IdData)->delete();
            session()->flash('success', "Event Report Deleted Successfully!!");

        } catch (\Exception $e) {
            session()->flash('error', "Something goes wrong!!");
        }
    }
    public function paginationView()
    {
        return 'livewire.pagination';
    }

}
