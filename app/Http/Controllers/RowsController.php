<?php

namespace App\Http\Controllers;

use App\Models\Rows;
use Illuminate\Http\Request;
use App\Imports\RowsImport;
//use Excel;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use Carbon\Carbon;
use Illuminate\Pagination\Paginator;



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
//        dd($request->file->hashName());
        $request->validate([
            'file' => 'required|mimes:xls,xlsx|max:2048', // size settings
        ]);

        $fileName = time().$request->file->hashName();//.$request->file->extension(); file->original_name

        $request->file->move(public_path('uploads'), $fileName);

        Rows::truncate();

        Excel::import(new RowsImport, public_path('uploads/'.$fileName)); //public function validateAndImport

        return response()->json('You have successfully upload file');

    }

    // Import data
//    public function import(Request $request){
//        Excel::import(new EmployeesImport, $request->file('file')->store('temp'));
//        return back()->with('success', 'Import successfully!');
//    }

    // Validate and Import data
    public function validateAndImport(Request $request){

        $filePath = $request -> filePath;

        Excel::import(new RowsImport, $filePath); //"employees.xlsx"

//        return back()->with('success', 'Import successfully!');
        return response()->json('Import successfully!');
    }
}
