<?php

namespace App\Http\Livewire\SecurityUser;

use App\Models\People;
use Livewire\Component;
use App\Models\EventType;
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
    public $searchWg = '';
    public $openModalWG = 'modal';
    public $selectedUser;
    public $Person = [];
    public $selectedWorkgroup;
    public $workgroup;
    public $workgroup_id;
    public $event_types_id;
    public $event_sub_types;
    public $user_id;
    public $workflow;
    public $showWG = true;
    public $ModalWorkgroup = [];
    public $data_id;
    public $workgroup1;
    public $wg_id;
    public $radio_select;
    public $openModal = '';
    public $search_companyLevel = '';
    public $search_workgroup = '';
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
            $deptORcont = $role->Workgroup->CompanyLevel->departemen_contractor;
            $job_class = $role->Workgroup->job_class;
            $eventtype = $role->event_type->name;
            $this->event_sub_types ="$eventtype";
            $this->event_types_id =$role->event_types_id;
            $this->workflow = $role->workflow;
            $this->workgroup1 = "$Bu-$deptORcont-$job_class";
            $this->selectedWorkgroup = $role->workgroup_id;
            $this->user_id = $role->user_id;
            $this->selectedUser = $role->user_id;
            $this->openModal = 'modal-open';
        }
    }
    public function render()
    {
        if(empty($this->workgroup)){
            $this->workgroup = $this->workgroup1;
        }
       
        $this->ModalWorkgroup = (!empty($this->wg_id)) ? Workgroup::with(['CompanyLevel', 'CompanyLevel.BussinessUnit'])->searchWG(trim($this->search_workgroup))->searchWgId(trim($this->wg_id))->orderBy('companyLevel_id', 'asc')->get() : Workgroup::with(['CompanyLevel', 'CompanyLevel.BussinessUnit'])->searchWG(trim($this->search_workgroup))->orderBy('companyLevel_id', 'asc')->get();

        $this->radioSelect();
        return view('livewire.security-user.update', [
            'Orang' => People::search(trim($this->search))->paginate(500, ['*'], 'commentsPage'),
            'ResponsibleRole' =>ResponsibleRole::get(),
            'CompanyLevel' => CompanyLevel::with(['BussinessUnit'])->deptcont(trim($this->search_companyLevel))->orderBy('bussiness_unit', 'asc')->get(),
            'EventTypes' => EventType::with('EventCategory')->get()
        ]);
    }
    public function radioSelect()
    {
        if ($this->radio_select === 'workgroup') {
            $this->search_workgroup = $this->searchWg;
            $this->wg_id = null;
            $this->search_companyLevel = "";
        } elseif ($this->radio_select === 'companyLevel') {
            $this->search_workgroup = "";
            $this->search_companyLevel = $this->searchWg;
        } else {
            $this->search_workgroup = $this->searchWg;
            $this->search_companyLevel = $this->searchWg;
        }
    }
// Workgroup Function
    public function cariUpdate($id)
    {
        $this->showWG = false;
        if (!empty($id)) {
            $id_Dept = CompanyLevel::with(['BussinessUnit'])->where('id', $id)->first()->id;
            $this->ModalWorkgroup = Workgroup::with(['CompanyLevel'])->where('companyLevel_id', $id_Dept)->get();
        } else {
            $this->ModalWorkgroup = Workgroup::with(['CompanyLevel'])->get();
        }

    }
    public function workGroupUpdate( $bu, $deptOrCont, $job_class)
    {

       
        $this->workgroup = "$bu-$deptOrCont-$job_class";
        $this->wgClickClose();
    }
    public function workGroup( $bu, $deptOrCont,$job_class)
    {
        $this->showWG = false;
        $this->workgroup = "$bu-$deptOrCont-$job_class";
    }
    public function btnsave()
    {
        $this->openModalWG = "modal ";
    }
    public function wgClick()
    {
        $this->openModalWG = 'modal modal-open';
    }
    public function wgClickClose()
    {
        $this->openModalWG = 'modal';

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
        $this->event_types_id = $id;
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
                'workgroup_id' => $this->selectedWorkgroup,
                'event_types_id' => $this->event_types_id,
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
