<?php

namespace App\Imports;

use App\Models\ManhoursRegister;
use Maatwebsite\Excel\Concerns\ToArray;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\SkipsEmptyRows;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ManhoursRegisterImport implements ToModel,WithHeadingRow,SkipsEmptyRows
{
    use Importable;
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new ManhoursRegister([
            'date'=>date('Y-m-d',strtotime($row['date'])),
            'company_category'=>$row['company_category'],
            'company'=>$row['company'],
            'dept'=>$row['dept'],
            'group'=>$row['group'],
            'role_class'=>$row['role_class'],
            'manhour'=>$row['manhour'],
            'manpower'=>$row['manpower'],
        ]);
    }
    public function isEmptyWhen(array $row): bool
    {
        return $row['date'] === '-';
        return $row['company_category'] === '-';
        return $row['company'] === '-';
        return $row['dept'] === '-';
        return $row['group'] === '-';
        return $row['role_class'] === '-';
        return $row['manhour'] === '-';
        return $row['manpower'] === '-';
    }
}
