<?php

namespace App\Imports;

use App\Models\CompanyLevel;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\SkipsEmptyRows;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class CompanyLevelImport implements ToModel,WithHeadingRow,SkipsEmptyRows
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new CompanyLevel([
            'level'=>$row['level'],
            'bussiness_unit'=>$row['bussiness_unit'],
            'departemen_contractor'=>$row['departemen_contractor']
        ]);
    }
}
