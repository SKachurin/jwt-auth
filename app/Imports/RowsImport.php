<?php

namespace App\Imports;

use App\Models\Rows;
//use Maatwebsite\Excel\Concerns\ToModel;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\ToCollection;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Facades\Redis;

class RowsImport implements ToCollection, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */

    public function collection(Collection $rows){

        // Validate
        Validator::make($rows->toArray(), [
            '*.row_id' => 'required|string',
            '*.name' => 'required|string',
            '*.date' => 'required|date',
        ],[
            '*.row_id.required'=> "The row_id field is required.",
            '*.row_id.string'=> "The username must be string.",
            '*.name.required'=> "The name field is required.",
            '*.name.string'=> "The name must be string.",
            '*.date.required'=> "The date field is required.",
            '*.date.email'=> "The date must be a valid date.",
        ])->validate();

        foreach ($rows as $row) {

            $row['date'] = \Carbon\Carbon::parse($row['date']);

            Rows::create([
                'row_id' => $row['row_id'],
                'name' => $row['name'],
                'date' => Carbon::parse($row['date'])->format('Y-m-d'),
            ]);
        }
    }

//    public function model(array $row)
//    {
//        return new Rows([
//            'row_id'     => $row[0],
//            'name'    => $row[1],
//            'date' => $row[2]
//
//        ]);
//    }
}
