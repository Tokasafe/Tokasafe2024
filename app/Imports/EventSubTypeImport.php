<?php

namespace App\Imports;

use App\Models\EventSubType;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class EventSubTypeImport implements ToModel,WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new EventSubType([
            'name'=>$row['name'],
            'eventType_id'=>$row['event_type_id'],
        ]);
    }
}
