<?php

namespace App\Http\Livewire\EventReport\Participan;

use App\Models\Companies;
use App\Models\People;
use App\Models\PihakTerlibat;
use App\Models\Roster;
use Livewire\Component;
use Vinkla\Hashids\Facades\Hashids;

class Create extends Component
{
    public $openModalName = '';
    public $openModalPerusahaan = '';
    public $search_name = '';
    public $search_company = '';
    public $name;
    public $id_karyawan;
    public $perusahaan;
    public $roster;
    public $sift;
    public $keterlibatan;
    public $pengalaman;
    public $id_details;

    public function mount($id)
    {
        $eventReportId = $id;
        $this->id_details = Hashids::decode($eventReportId)[0];

    }
    public function render()
    {

        return view('livewire.event-report.participan.create', [
            'People' => People::with('Employer')->search(trim($this->search_name))->get(),
            'Company' => Companies::with(['CompanyCategory'])->searchcompany(trim($this->search_company))->get(),
            'Roster' => Roster::get(),
        ]);
    }
// store
    public function store()
    {

        $this->validate([
            'name' => 'required',
            'id_karyawan' => 'required',
            'perusahaan' => 'required',
            'roster' => 'required',
            'sift' => 'required',
            'keterlibatan' => 'required',
            'pengalaman' => 'required',

        ]);
        try {
            PihakTerlibat::create([
                'event_report_id' => $this->id_details,
                'name' => $this->name,
                'id_karyawan' => $this->id_karyawan,
                'perusahaan' => $this->perusahaan,
                'roster' => $this->roster,
                'sift' => $this->sift,
                'keterlibatan' => $this->keterlibatan,
                'pengalaman' => $this->pengalaman,
            ]);
            session()->flash('success', 'Data Updated Successfully!!');
            $this->emit('Add_Keterlibatan');
            $this->clearFields();
        } catch (\Exception $ex) {
            session()->flash('success', 'Something goes wrong!!');
        }
    }
// function for modal
    public function nameByClick()
    {
        $this->openModalName = 'modal-open';
    }
    public function cari_name($id)
    {

        if (!empty($id)) {
            $reportBy = People::with('Employer')->whereId($id)->first();
            $this->name = $reportBy->lookup_name;
            $this->nameByClickClose();
        }
    }
    public function nameByClickClose()
    {
        $this->openModalName = '';
    }
    public function perusahaanByClick()
    {
        $this->openModalPerusahaan = 'modal-open';
    }
    public function cari_perusahaan($id)
    {

        if (!empty($id)) {
            $perusahaan = Companies::with('CompanyCategory')->whereId($id)->first();
            $this->perusahaan = $perusahaan->name;
            $this->perusahaanByClickClose();
        }
    }
    public function perusahaanByClickClose()
    {
        $this->openModalPerusahaan = '';
    }
// function clear fields
    public function clearFields()
    {
        $this->name = '';
        $this->id_karyawan = '';
        $this->perusahaan = '';
        $this->roster = '';
        $this->sift = '';
        $this->keterlibatan = '';
        $this->pengalaman = '';
    }
}
