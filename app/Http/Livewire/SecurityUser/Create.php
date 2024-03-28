<?php

namespace App\Http\Livewire\SecurityUser;

use App\Models\CompanyLevel;
use App\Models\EventSubType;
use App\Models\People;
use App\Models\ResponsibleRole;
use App\Models\UserSecurity;
use App\Models\Workgroup;
use Livewire\Component;
use Livewire\WithPagination;

class Create extends Component
{
    use WithPagination;
    public $search = '';
    public $openModalWG = '';
    public $openModalEST = '';
    public $selectedUser = [];
    public $event_sub_types_id;
    public $event_sub_types;
    public $workgroup;
    public $workgroup_id;
    public $workflow;
    public $CompanyLevel;
    public $showWG = true;
    public $ModalWorkgroup = [];

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
        return view('livewire.security-user.create', [
            'People' => People::search(trim($this->search))->paginate(10),
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
        $this->resetPage();
        $this->openModalWG = '';
        
    }
    public function subtypeClick($id, $eventType,$subtype){
        $this->event_sub_types_id = $id;
        $this->event_sub_types = "$eventType-$subtype";
        $this->EventSubtypeClose();
    }
    public function EventSubtypeClick()
    {
        $this->openModalEST = 'modal-open';
    }
    public function EventSubtypeClose()
    {
        $this->resetPage();
        $this->openModalEST = '';
    }
// Store Function

    public function store()
    {
        $this->validate([
            'selectedUser' => 'required',
            'workflow' => 'required',
            'workgroup' => 'required',
            'event_sub_types' => 'required',
        ]);
        foreach ($this->selectedUser as $key => $value) {
            UserSecurity::create([
                'user_id' => $this->selectedUser[$key],
                'workflow' => $this->workflow,
                'workgroup_id' => $this->workgroup_id,
                'event_sub_types_id' => $this->event_sub_types_id,
            ]);
        }
        session()->flash('success', 'Data added Successfully!!');
        $this->clearFields();
        $this->emit('AddUserSecurity');
    }

    public function updatedSelectAll($value)
    {
        if ($value) {
            $this->selectedUser = People::pluck('id');
        } else {
            $this->selectedUser = [];
        }

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
