<?php

namespace App\Actions;

use App\Models\File;
use App\Models\Rows;
use App\Imports\RowsImport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ParseFile {

    public function parse(File $file){

        $this->file = $file;

        Rows::truncate();

        Excel::import(new RowsImport, public_path('uploads/'.$file->name));


        //laravel echo
        return response()->json('Import successfully!');

    }
}


