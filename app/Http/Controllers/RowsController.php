<?php

namespace App\Http\Controllers;

use App\Models\Rows;
use Illuminate\Http\Request;
use App\Imports\RowsImport;
//use Excel;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redis;
use Maatwebsite\Excel\Facades\Excel;
use Carbon\Carbon;
use App\Models\File;
use Illuminate\Support\Facades\Cache;



class RowsController extends Controller
{
    public function index(){
        $RowsLinks = Rows::select('id','name', DB::raw('DATE(date) as date'))
            ->get()
            ->groupBy('date');


        return view('index')->with(['RowsLinks' => $RowsLinks]);

    }

     /**size settings
     * php.ini
     * upload_max_filesize = 2M
     * post_max_size = 8M
     * Nginx
     * nginx.conf file: client_max_body_size */

    public function store(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xls,xlsx|max:2048', // size settings
        ]);

        $fileName = time().$request->file->hashName();

        $request->file->move(public_path('uploads'), $fileName);

        //create File for Observer
        $file = new File();
        $file->name = $fileName;
        $file->save();

//        Rows::truncate();
//        Excel::import(new RowsImport, public_path('uploads/'.$fileName)); //public function validateAndImport

        return response()->json('You have successfully upload file');

    }

    public function number(Request $request)
    {

        $a = Redis::connection('cache')->keys('*');

        return (count($a)-1);
    }
}
