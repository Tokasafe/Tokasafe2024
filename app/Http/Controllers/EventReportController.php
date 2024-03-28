<?php

namespace App\Http\Controllers;

use App\Models\EventReport;
use App\Models\StatusEvent;
use App\Models\WorkflowStep;
use Illuminate\Http\Request;
use Vinkla\Hashids\Facades\Hashids;

class EventReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        return view('livewire.event-report.details');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public $report = [];
    public $event_id;
    public function show(Request $request, $id)
    {
        $this->event_id = $id;
        $decoded_id = Hashids::decode($id);
        $this->report = EventReport::whereId($decoded_id[0])->first();
        $reportBy = StatusEvent::where('event_report_id',$decoded_id[0])->first()->moderator_report;
        $time = StatusEvent::where('event_report_id',$decoded_id[0])->first()->updated_at;

        $bu = $this->report->Workgroup->CompanyLevel->BussinessUnit->name;
        $deptORcont = $this->report->Workgroup->CompanyLevel->deptORcont;
        $job_class = $this->report->Workgroup->job_class;
        $type_kejadian = $this->report->type_kejadian;
        $workflowTemplate = WorkflowStep::where('eventTypeId', $type_kejadian)->first()->workflow_template;

        return view('livewire.event-report.details', [
            'EventReport' => $this->event_id,
            'Tanggal' => $this->report->tgl_kejadian,
            'Workgroup' => "$bu-$deptORcont-$job_class",
            'Workflow_Template' => $workflowTemplate,
            'reportBy' => $reportBy,
            'time' => $time,
        ], ['header' => 'Event Report']);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
