<?php

namespace App\Imports;

use App\Models\EventType;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class EventTypeImport implements ToModel,WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new EventType([
            'name'=>$row['name'],
            'eventCategory_id'=>$row['event_category_id'],
        ]);
    }
}
