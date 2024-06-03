<?php

namespace App\Http\Livewire\EventReportList\Insident\Action;

use Livewire\Component;
use App\Models\IncidentAction;
use Livewire\WithPagination;

class Index extends Component
{
    public $data_id, $modalDelete = "modal", $delete_id;
    use WithPagination;
    public function mount($id)
    {
        $this->data_id = $id;
    }
    protected $listeners = [
        'addActionIncident' => 'render',
        'UpdateAction_Incident' => 'render'
    ];
    public function render()
    {
        return view('livewire.event-report-list.insident.action.index', [
            'IncidentAction' => IncidentAction::with(['People','IncidentAction'])->where('incident_report_id', $this->data_id)->paginate(10)
        ]);
    }
    public function update($id)
    {
        $this->emit('UpdateActionIncident', $id);
    }

    public function delete($id)
    {
        $this->modalDelete = "modal modal-open";
        $this->delete_id = $id;
    }
    public function deleteFileAction()
    {
        try {
            $this->modalDelete = "modal";
            IncidentAction::find($this->delete_id)->delete();
            session()->flash('success', "Deleted Successfully!!");
        } catch (\Exception $e) {
            session()->flash('error', "Something goes wrong!!");
        }
    }
}
