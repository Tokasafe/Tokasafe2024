<?php

namespace App\Http\Livewire\EventReportList\HazardId;

use Livewire\Livewire;
use Livewire\Component;
use App\Models\HazardId;
use App\Models\EventType;
use App\Models\EventAction;
use App\Models\EventSubType;
use Livewire\WithPagination;
use App\Models\PanelHazardId;
use App\Models\Workgroup;
use Clockwork\Request\Timeline\Event;

class Index extends Component
{
    use WithPagination;
    public $eventAction = [];
    public $event_action = [];
    public $eventType;
    public $reference;
    public $documentation;
    public $IdData;
    public $search_wg;
    public $month = '';
    public $tglMulai = '';
    public $endDate = '';
    public $dateRange = '';
    public $search_eventsubtype = '';

    protected $listeners = [
        'TglMulai',
        'TglAkhir',
        'hazard_add' => 'render',
    ];
    public function TglMulai($value)
    {
        if (!is_null($value)) {
            $this->tglMulai = date('Y-m-d', strtotime($value));
        }
    }
    public function TglAkhir($value)
    {
        if (!is_null($value)) {
            $this->endDate = date('Y-m-d', strtotime($value));
            // dd($this->endDate);
        }
    }
    public function render()
    {
        if (empty($this->dateRange)) {
            if (!empty(HazardId::orderby('tanggal_kejadian', 'asc')->first()->tanggal_kejadian)) {
                $this->tglMulai = HazardId::orderby('tanggal_kejadian', 'asc')->first()->tanggal_kejadian;
                $this->endDate = HazardId::orderby('tanggal_kejadian', 'desc')->first()->tanggal_kejadian;
            } else {
                $this->tglMulai = "";
                $this->endDate = "";
            }
        }
        if (!empty($this->dateRange)) {
            $this->month = '';
        } elseif (!empty($this->month)) {
            $this->dateRange = '';
        }
        $this->event_action = EventAction::with('HazardId')->get();
        return view('livewire.event-report-list.hazard-id.index', [
            'PanelHazardId' => PanelHazardId::with([
                'Hazard.EventSubType',
                'Hazard.Workgroup.CompanyLevel.BussinessUnit',
                'WorkflowStep.StatusCode',
            ])->dateRange([trim($this->tglMulai), trim($this->endDate)])->month(trim($this->month))->reference(trim($this->search_eventsubtype))->workgroup(trim($this->search_wg))->latest()->paginate(10),
            'EventSubType' => EventSubType::where('eventType_id', 1)->get(),
            'Workgroup' => Workgroup::with([
                'CompanyLevel',
                'CompanyLevel.BussinessUnit',
            ])->get()
        ])->extends('navigation.homebase', ['header' => 'Hazard report'])->section('content');
    }
    public function delete($id)
    {
        $this->IdData = $id;
        $this->reference = HazardId::whereId($id)->first()->reference;
        $this->documentation = HazardId::whereId($id)->first()->documentation;
    }
    public function deleteFile()
    {
        try {
            EventAction::where('event_hzd_id', $this->IdData)->delete();
            HazardId::find($this->IdData)->delete();
            if ($this->documentation) {
                unlink(storage_path('app/public/documents/' . $this->documentation));
            }
            session()->flash('success', "Hazard Report Deleted Successfully!!");
        } catch (\Exception $e) {
            session()->flash('error', "Something goes wrong!!");
        }
    }
    public function paginationView()
    {
        return 'livewire.pagination';
    }
}
