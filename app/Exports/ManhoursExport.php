<?php

namespace App\Exports;

use App\Models\ManhoursRegister;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ManhoursExport implements FromQuery, WithMapping, WithHeadings
{
    use Exportable;
    public $selectedManhours;
    public function __construct($selectedManhours)
    {
        $this->selectedManhours = $selectedManhours;
    }
    /**
     * @return \Illuminate\Support\Collection
     */
    public function map($manhour): array
    {

        return [
            date('M-Y', strtotime($manhour->date)),
            $manhour->company_category,
            $manhour->company,
            $manhour->dept,
            $manhour->group,
            $manhour->role_class,
            $manhour->manhour,
            $manhour->manpower,
        ];
    }
    public function headings(): array
    {
        return [
            'MONTH',
            'COMPANY CATEGORY',
            'COMPANY',
            'DEPARTMENT',
            'DEPT GROUP',
            'JOB CLASS',
            'MANHOURS',
            'MANPOWER',
        ];
    }

    public function query()
    {
        return ManhoursRegister::whereIn('id', $this->selectedManhours);
    }
}
