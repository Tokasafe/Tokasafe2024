<?php

namespace App\Imports;

use App\Models\People;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
class PeopleImport implements ToModel ,WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new People([
            'lookup_name'=>$row['lookup_name'],
            'employe_id'=>$row['employe_id'],
            'network_username'=>$row['network_username'],
            'gender'=>$row['gender'],
            'date_of_birth'=>$row['date_of_birth'],
            'date_commenced'=>$row['date_commenced'],
            'employer'=>$row['employer'],
        ]);
    }
}
