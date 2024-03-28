<?php

namespace App\Http\Livewire\People;

use App\Models\Port;
use App\Models\People;
use Livewire\Component;
use App\Models\Companies;
use App\Models\Workgroup;
use App\Models\CompanyLevel;
use App\Imports\PeopleImport;
use Livewire\WithFileUploads;
use Maatwebsite\Excel\Facades\Excel;

class Create extends Component
{
    use WithFileUploads;
    public $first_name;
    public $last_name;
    public $lookup_name;
    public $workgroup;
    public $employer;
    public $employer_id;
    public $emergency_response;
    public $supervisor;
    public $supervisor_id;
    public $employe_id;
    public $gender;
    public $date_of_birth;
    public $date_commenced;
    public $home_port;
    public $point_of_hire;
    public $network_username;
    public $employee_photo;
    public $fileImport;

    public $radio_select;
    public $openModalWG = '';
    public $openEmployee = '';
    public $openSupervisor = '';
    public $search_workgroup = '';
    public $search_employee = '';

    public $CompanyLevel = [];
    public $ModalWorkgroup = [];
    public $showWG = true;

    public function render()
    {
        if (empty($this->last_name)) {
            $this->lookup_name = ucwords($this->first_name);
        } else {
            $upr_lastName = strtoupper($this->last_name);
            $uc_firstName = ucwords($this->first_name);
            $this->lookup_name = "$upr_lastName ,$uc_firstName";
        }
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
        return view('livewire.people.create', [
            'Company' => Companies::with(['CompanyCategory'])->searchcompany(trim($this->search_employee))->get(),
            'Port' => Port::get(),
            'Orang' => People::search($this->search_employee)->paginate(100)
        ]);
    }

//Cari function
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
    public function workGroup($bu, $deptOrCont, $job_class)
    {
        $this->workgroup = "$bu-$deptOrCont-$job_class";
        $this->wgClickClose();
    }
    public function clearSearchWg()
    {

        $this->search_workgroup = '';
        $this->radio_select = '';
        $this->radio_select = '';
        $this->radio_select = '';

    }

    public function cari_employee($id)
    {

        if (!empty($id)) {
            $this->employer = Companies::whereId($id)->first()->name;
            $this->employer_id = Companies::whereId($id)->first()->id;
            $this->EmployeClickClose();
        }
    }
    public function cari_supervisor($id)
    {

        if (!empty($id)) {
            $this->supervisor = People::whereId($id)->first()->lookup_name;
            $this->spvClickClose();
        }
    }
    public function cari_reportBy($id)
    {

        if (!empty($id)) {
            $this->employer = Companies::whereId($id)->first()->name;
            $this->employer_id = Companies::whereId($id)->first()->id;
            $this->EmployeClickClose();
        }
    }
    public function uploadPeople(){
        $this->validate(['fileImport' => 'required']);
        Excel::import(new PeopleImport,$this->fileImport);
        session()->flash('success', "importing file has done!!");
        $this->emit('Add_People');
    }
// store
    public function store()
    {
       
        $this->validate([
            // 'first_name' => 'required',
            // 'last_name' => 'required',
            'lookup_name' => 'required',
            'workgroup' => 'required',
            'employer' => 'required',
            // 'emergency_response' => 'required',
            // 'supervisor' => 'required',
            'employe_id' => 'required',
            'gender' => 'required',
            'date_of_birth' => 'required',
            'date_commenced' => 'required',
            'home_port' => 'required',
            // 'point_of_hire' => 'required',
            // 'network_username' => 'required',
            // 'employee_photo' => 'required',

        ]);

        People::create([
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'lookup_name' => $this->lookup_name,
            'workgroup' => $this->workgroup,
            'employer' => $this->employer_id,
            'emergency_response' => $this->emergency_response,
            'supervisor' => $this->supervisor,
            'employe_id' => $this->employe_id,
            'gender' => $this->gender,
            'date_of_birth' => $this->date_of_birth,
            'date_commenced' => $this->date_commenced,
            'home_port' => $this->home_port,
            'point_of_hire' => $this->point_of_hire,
            'network_username' => $this->network_username,
            'employee_photo' => $this->employee_photo,
        ]);
        session()->flash('success', 'Data added Successfully!!');
        $this->emit('Add_People');
        $this->clearFields();
    }
    public function clearFields()
    {
        $this->first_name = '';
        $this->last_name = '';
        $this->lookup_name = '';
        $this->workgroup = '';
        $this->employer = '';
        $this->employer_id = '';
        $this->emergency_response = '';
        $this->supervisor = '';
        $this->employe_id = '';
        $this->gender = '';
        $this->date_of_birth = '';
        $this->date_commenced = '';
        $this->home_port = '';
        $this->point_of_hire = '';
        $this->network_username = '';
        $this->employee_photo = '';
    }

    // FUNCTION BTN MODAL
    public function wgClick()
    {
        $this->openModalWG = 'modal-open';
    }
    public function wgClickClose()
    {
        $this->openModalWG = '';
        $this->clearSearchWg();
        $this->ModalWorkgroup = [];
    }
    public function EmployeClick()
    {
        $this->openEmployee = 'modal-open';
    }
    public function EmployeClickClose()
    {
        $this->openEmployee = '';
    }
    public function spvClick()
    {
        $this->openSupervisor = 'modal-open';
    }
    public function spvClickClose()
    {
        $this->openSupervisor = '';
    }
}
