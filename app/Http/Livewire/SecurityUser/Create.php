<?php

namespace App\Http\Livewire\SecurityUser;

use App\Models\CompanyLevel;
use App\Models\EventSubType;
use App\Models\EventType;
use App\Models\People;
use App\Models\ResponsibleRole;
use App\Models\UserSecurity;
use App\Models\Workgroup;
use Livewire\Component;
use Livewire\WithPagination;

class Create extends Component
{
    use WithPagination;
    public $search_workgroup = '';
    public $search = '';
    public $searchLevel = '';
    public $openModalWG = 'modal';
    public $openModalEST = '';
    public $search_companyLevel = '';
    public $selectedUser = [];
    public $selectedWorkgroup = [];
    public $event_types_id;
    public $event_sub_types;
    public $workgroup;
    public $radio_select;
    public $workgroup_id;
    public $ComapanyLevel_id;
    public $wg_id;
    public $workflow;
    public $selectAllWg;
    public $showWG = true;
    public $ModalWorkgroup = [];
    
    public function render()
    {
        if (empty($this->selectedWorkgroup)) {
           $this->workgroup="";
        }
        $this->ModalWorkgroup = (!empty($this->wg_id)) ? Workgroup::with(['CompanyLevel', 'CompanyLevel.BussinessUnit'])->searchWG(trim($this->search_workgroup))->searchWgId(trim($this->wg_id))->orderBy('companyLevel_id', 'asc')->get() : Workgroup::with(['CompanyLevel', 'CompanyLevel.BussinessUnit'])->searchWG(trim($this->search_workgroup))->orderBy('companyLevel_id', 'asc')->get();

        $this->radioSelect();
        return view('livewire.security-user.create', [
            'People' => People::search(trim($this->search))->paginate(500),
            'ResponsibleRole' => ResponsibleRole::get(),
            'CompanyLevel' => CompanyLevel::with(['BussinessUnit'])->deptcont(trim($this->search_companyLevel))->orderBy('bussiness_unit', 'asc')->get(),
            'EventTypes' => EventType::with('EventCategory')->get()
        ]);
    }
    public function updatedSelectAllWg($value)
    {
        $main =  (!empty($this->wg_id)) ? Workgroup::with(['CompanyLevel', 'CompanyLevel.BussinessUnit'])->searchWG(trim($this->search_workgroup))->searchWgId(trim($this->wg_id))->orderBy('companyLevel_id', 'asc')->pluck('id') : Workgroup::with(['CompanyLevel', 'CompanyLevel.BussinessUnit'])->searchWG(trim($this->search_workgroup))->orderBy('companyLevel_id', 'asc')->pluck('id');
        if ($value) {
            $this->selectedWorkgroup = $main;
        } else {
            $this->selectedWorkgroup = [];
        }
    }
    // Workgroup Function
    public function radioSelect()
    {
        if ($this->radio_select === 'workgroup') {
            $this->search_workgroup = $this->search;
            $this->wg_id = null;
            $this->search_companyLevel = "";
        } elseif ($this->radio_select === 'companyLevel') {
            $this->search_workgroup = "";
            $this->search_companyLevel = $this->search;
        } else {
            $this->search_workgroup = $this->search;
            $this->search_companyLevel = $this->search;
        }
    }
    public function cari($id)
    {
        $this->selectedWorkgroup=[];
        $this->showWG = false;
        if ($id) {
            $this->ComapanyLevel_id = $id;
            $this->ModalWorkgroup = Workgroup::with(['CompanyLevel', 'CompanyLevel.BussinessUnit',])->where('companyLevel_id', $id)->get();
        } else {
            $this->ModalWorkgroup = Workgroup::with(['CompanyLevel', 'CompanyLevel.BussinessUnit',])->get();
        }
    }
    public function workGroup( $bu, $deptOrCont)
    {
        $this->showWG = false;
        $this->workgroup = "$bu-$deptOrCont";
    }
    public function allWorkgroup( $wg)
    {
        $this->showWG = false;
        $this->workgroup = "$wg";

       
    }
    public function wgClick()
    {
        $this->openModalWG = "modal modal-open";
    }
    public function btnsave()
    {
        $this->openModalWG = "modal ";
    }

  
   
    public function wgClickClose()
    {
        
        $this->resetPage();
        $this->openModalWG = 'modal';
        $this->selectedWorkgroup=[];
    }
    public function EventSubtypeClick()
    {
        $this->openModalEST = 'modal-open';
    }
    public function subtypeClick($id, $eventType)
    {
        $this->event_types_id = $id;
        $this->event_sub_types = "$eventType";
        $this->EventSubtypeClose();
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
            foreach ($this->selectedWorkgroup as $wg => $value) {


                UserSecurity::create([
                    'user_id' => $this->selectedUser[$key],
                    'workflow' => $this->workflow,
                    'workgroup_id' => $this->selectedWorkgroup[$wg],
                    'event_types_id' => $this->event_types_id,
                ]);
            }
        }
        session()->flash('success', 'Data added Successfully!!');
        $this->clearFields();
        $this->emit('AddUserSecurity');
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
