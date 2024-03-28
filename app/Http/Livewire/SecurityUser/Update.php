<?php

namespace App\Http\Livewire\SecurityUser;

use App\Models\People;
use Livewire\Component;
use App\Models\Workgroup;
use App\Models\CompanyLevel;
use App\Models\EventSubType;
use App\Models\UserSecurity;
use Livewire\WithPagination;
use App\Models\ResponsibleRole;

class Update extends Component
{
    use WithPagination;
    public $search = '';
    public $openModalWG = '';
    public $selectedUser;
    public $Person = [];
    public $workgroup;
    public $workgroup_id;
    public $event_sub_types_id;
    public $event_sub_types;
    public $user_id;
    public $workflow;
    public $CompanyLevel;
    public $showWG = true;
    public $ModalWorkgroup = [];
    public $data_id;
    public $openModal = '';
    public $openModalEST = '';
    protected $listeners = [

        'DataUpdate',
    ];
    public function DataUpdate($value)
    {
        if (!is_null($value)) {
            $this->data_id = $value;
            $role = UserSecurity::where('id', $this->data_id)->first();
            $Bu = $role->Workgroup->CompanyLevel->BussinessUnit->name;
            $deptORcont = $role->Workgroup->CompanyLevel->deptORcont;
            $job_class = $role->Workgroup->job_class;
            $eventtype = $role->eventsubtype->EventType->name;
            $subtype = $role->eventsubtype->name;
            $this->event_sub_types ="$eventtype-$subtype";
            $this->event_sub_types_id =$role->event_sub_types_id;
            $this->workflow = $role->workflow;
            $this->workgroup = "$Bu-$deptORcont-$job_class";
            $this->workgroup_id = $role->workgroup_id;
            $this->user_id = $role->user_id;
            $this->selectedUser = $role->user_id;
            $this->openModal = 'modal-open';
        }
    }
    public function render()
    {

        if (!empty($this->radio_select)) {
            if ($this->radio_select == 'companyLevel') {
                $this->CompanyLevel = CompanyLevel::with(['BussinessUnit'])->deptcont(trim($this->search_workgroup))->orderBy('bussiness_unit', 'asc')->orderBy('level', 'desc')->get();
            } else {
                if ($this->showWG == true) {
                    $this->ModalWorkgroup = Workgroup::with(['CompanyLevel'])->searchWG(trim($this->search_workgroup))->orderBy('companyLevel_id', 'asc')->get();
                }
            }
        } else {

            $this->CompanyLevel = CompanyLevel::with(['BussinessUnit'])->orderBy('bussiness_unit', 'asc')->orderBy('level', 'desc')->get();
        }

        return view('livewire.security-user.update', [
            'People' => People::search(trim($this->search))->paginate(5),
            'ResponsibleRole' =>ResponsibleRole::get(),
            'SubType'=>EventSubType::with('EventType')->get()
        ]);
    }
// Workgroup Function
    public function cari($id)
    {
        $this->showWG = false;
        if (!empty($id)) {
            $id_Dept = CompanyLevel::with(['BussinessUnit'])->where('id', $id)->first()->id;
            $this->ModalWorkgroup = Workgroup::with(['CompanyLevel'])->where('companyLevel_id', $id_Dept)->get();
        } else {
            $this->ModalWorkgroup = Workgroup::with(['CompanyLevel'])->get();
        }

    }
    public function workGroup($id, $bu, $deptOrCont, $job_class)
    {

        $this->workgroup_id = $id;
        $this->workgroup = "$bu-$deptOrCont-$job_class";
        $this->wgClickClose();
    }

    public function wgClick()
    {
        $this->openModalWG = 'modal-open';
    }
    public function wgClickClose()
    {
        $this->openModalWG = '';

    }
    public function outModal()
    {
        $this->openModal = '';
    }
    public function EventSubtypeClick()
    {
       
        $this->openModalEST = 'modal-open';
    }
    public function subtypeClick($id, $eventType,$subtype){
        $this->event_sub_types_id = $id;
        $this->event_sub_types = "$eventType-$subtype";
        $this->EventSubtypeClose();
    }
    public function EventSubtypeClose()
    {
        $this->resetPage();
        $this->openModalEST = '';
    }
    public function store()
    {

        $this->validate([
            'selectedUser' => 'required',
            'workflow' => 'required',
            'workgroup' => 'required',
            'event_sub_types' => 'required',
        ]);
        try {
            UserSecurity::whereId($this->data_id)->update([
                'user_id' => $this->selectedUser,
                'workflow' => $this->workflow,
                'workgroup_id' => $this->workgroup_id,
                'event_sub_types_id' => $this->event_sub_types_id,
            ]);
            session()->flash('success', 'Data Updated Successfully!!');
            $this->clearFields();
            $this->clearSelect();
        } catch (\Exception $ex) {
            session()->flash('success', 'Something goes wrong!!');
        }
        $this->emit('UpdateUserSecurity');
        $this->openModal = '';
    }

    public function clearSelect()
    {
        $this->selectedUser = [];
        $this->search = '';
    }
    public function clearFields()
    {
        $this->selectedUser = [];
        $this->workflow = '';
        $this->workgroup = '';
    }
    public function updatingSearch()
    {
        $this->resetPage();
    }
}
