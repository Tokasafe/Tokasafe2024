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
    public $search_workgroup = '';
    public $search = '';
    public $searchLevel = '';
    public $openModalWG = '';
    public $openModalEST = '';
    public $selectedUser = [];
    public $selectedWorkgroup = [];
    public $event_sub_types_id;
    public $event_sub_types;
    public $workgroup;
    public $radio_select;
    public $workgroup_id;
    public $ComapanyLevel_id;
    public $workflow;
    public $CompanyLevel;
    public $showWG = true;
    public $ModalWorkgroup = [];

    public function render()
    {
        if (empty($this->selectedWorkgroup)) {
           $this->workgroup="";
        }
        if (!empty($this->radio_select)) {
            if ($this->radio_select === 'companyLevel') {
                $this->CompanyLevel = CompanyLevel::with(['BussinessUnit'])->deptcont(trim($this->search_workgroup))->orderBy('bussiness_unit', 'asc')->orderBy('level', 'desc')->get();
            }
            if ($this->radio_select === 'workgroup') {
               
                    $this->ModalWorkgroup = Workgroup::with(['CompanyLevel', 'CompanyLevel.BussinessUnit',])->searchWG(trim($this->search_workgroup))->orderBy('companyLevel_id', 'asc')->get();
                
            }
        } else {

            $this->CompanyLevel = CompanyLevel::with(['BussinessUnit'])->orderBy('bussiness_unit', 'asc')->orderBy('level', 'desc')->get();
        }
        return view('livewire.security-user.create', [
            'People' => People::search(trim($this->search))->paginate(10),
            'ResponsibleRole' => ResponsibleRole::get(),
            'SubType' => EventSubType::with('EventType')->get(),
        ]);
    }
    // Workgroup Function
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
    public function btnsave()
    {
        $this->openModalWG = '';
    }
    public function wgClick()
    {
        $this->openModalWG = 'modal-open';
    }
  
   
    public function wgClickClose()
    {
        
        $this->resetPage();
        $this->openModalWG = '';
        $this->selectedWorkgroup=[];
    }
    public function subtypeClick($id, $eventType, $subtype)
    {
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
            foreach ($this->selectedWorkgroup as $wg => $value) {


                UserSecurity::create([
                    'user_id' => $this->selectedUser[$key],
                    'workflow' => $this->workflow,
                    'workgroup_id' => $this->selectedWorkgroup[$wg],
                    'event_sub_types_id' => $this->event_sub_types_id,
                ]);
            }
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
