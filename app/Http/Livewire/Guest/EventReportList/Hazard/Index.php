<?php

namespace App\Http\Livewire\Guest\EventReportList\Hazard;

use Livewire\Component;
use App\Models\HazardId;
use App\Models\Workgroup;
use App\Models\EventAction;
use App\Models\EventSubType;
use Livewire\WithPagination;
use App\Models\PanelHazardId;

class Index extends Component
{
    use WithPagination;
    public $eventAction=[];
    public $event_action=[];
    public $eventType;
    public $reference;
    public $documentation;
    public $IdData;
    public $month = '';
    public $search_wg = '';
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
            }
            else{
                $this->tglMulai="";
                $this->endDate="";
            }
        }
        if (!empty($this->dateRange)) {
            $this->month='';
        }
        elseif (!empty($this->month)) {
            $this->dateRange='';
        }

        $this->event_action = EventAction::with('HazardId')->get();
        return view('livewire.guest.event-report-list.hazard.index',[
            'PanelHazardId' => PanelHazardId::with([
                'Hazard.EventSubType',
                'Hazard.Workgroup.CompanyLevel.BussinessUnit',
                'WorkflowStep.StatusCode',

            ])->dateRange([trim($this->tglMulai), trim($this->endDate)])->month(trim($this->month))->reference(trim($this->search_eventsubtype))->workgroup(trim($this->search_wg))->latest()->paginate(10),
            'EventSubType' => EventSubType::where('eventType_id', 1)->get(),
            'Workgroup'=> Workgroup::with([
                'CompanyLevel',
                'CompanyLevel.BussinessUnit',])->orderBy('companyLevel_id')->get()
        ])->extends('navigation.guest.guestbase', ['header' => 'Hazard report'])->section('contentUser');
    }
}
