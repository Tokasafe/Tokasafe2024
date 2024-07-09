<?php

namespace App\Http\Livewire\EventReportList\Insident;

use App\Models\EventSubType;
use App\Models\EventType;
use App\Models\IncidentAction;
use App\Models\IncidentReport;
use App\Models\PanelIncident;
use App\Models\Workgroup;
use Livewire\Component;

class Index extends Component
{
    public $data_id, $reference, $modal = 'modal', $documentation, $Incident_Action = [], $EventSubType = [], $tglMulai = '', $hasilTangal, $endDate = '', $dateRange = '', $search_SubEventType = '', $search_eventType = '', $month = '', $search_Workgroup = '';
    protected $listeners = [

        'TglMulaiIncident',
        'TglAkhirIncident',
        'IncidentTable' => 'render',
    ];
    public function TglMulaiIncident($value)
    {
        if (!is_null($value)) {
            $this->tglMulai = date('Y-m-d', strtotime($value));
        }
    }
    public function TglAkhirIncident($value)
    {
        if (!is_null($value)) {
            $this->endDate = date('Y-m-d', strtotime($value));
            // dd($this->endDate);
        }
    }
    public function render()
    {
        if (empty($this->dateRange)) {
            if (IncidentReport::orderby('date_event', 'asc')->first()) {
                $this->tglMulai = IncidentReport::orderby('date_event', 'asc')->first()->date_event;
                $this->endDate = IncidentReport::orderby('date_event', 'desc')->first()->date_event;
            } else {
                $this->tglMulai = '';
                $this->endDate = '';
            }
        }
        if ($this->search_eventType) {
            $this->EventSubType = EventSubType::orderBy('name')->where('eventType_id', $this->search_eventType)->get();
        } else {
            $this->EventSubType = EventSubType::orderBy('name')->get();
        }
        $this->Incident_Action = IncidentAction::with('IncidentAction')->get();
        return view('livewire.event-report-list.insident.index', [
            'Incident' => PanelIncident::dateRange([trim($this->tglMulai), trim($this->endDate)])
                ->searchEventType(trim($this->search_eventType))
                ->searchSubEventType(trim($this->search_SubEventType))
                ->searchMonth(trim($this->month))
                ->searchWorkgroup(trim($this->search_Workgroup))
                ->with(['Incident.eventType', 'Incident.eventSubType', 'Incident.workgroup.CompanyLevel.BussinessUnit', 'WorkflowStep.StatusCode'])->paginate(100, ['*'], 'IncidentPage'),
            'EventType' => EventType::orderBy('name')->where('eventCategory_id', 2)->get(),
            'Workgroup' => Workgroup::with([
                'CompanyLevel',
                'CompanyLevel.BussinessUnit',
            ])->orderBy('companyLevel_id')->get()

        ])->extends('navigation.homebase', ['header' => 'Incident report', 'title' => 'Incident report'])->section('content');
    }

    public function delete($id)
    {
        $this->modal = 'modal modal-open';
        $this->data_id = $id;
        $this->reference = IncidentReport::find($id)->reference;
        $this->documentation = IncidentReport::find($id)->documentation;
    }

    public function deleteFile()
    {
        // try {
        IncidentAction::where('incident_report_id', $this->data_id)->delete();
        IncidentReport::find($this->data_id)->delete();
        if ($this->documentation) {
            unlink(storage_path('app/public/documents/' . $this->documentation));
        }
        session()->flash('success', "Hazard Report Deleted Successfully!!");
        $this->modal = 'modal';
        // } catch (\Exception $e) {
        //     session()->flash('error', "Something goes wrong!!");
        // }
    }
    public function closeModal()
    {
        $this->modal = 'modal';
    }
}
