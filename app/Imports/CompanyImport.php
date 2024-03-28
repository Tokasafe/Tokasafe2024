<?php

namespace App\Imports;

use App\Models\Companies;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
class CompanyImport implements ToModel,WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Companies([
            'category_company'=>$row['category_company'],
            'name'=>$row['name']
        ]);
    }
}
