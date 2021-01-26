<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Imports\RequisitionImport;
use Maatwebsite\Excel\Facades\Excel;

class Import_Controller extends Controller
{
    public function requisition_import(Request $request){
        Excel::import(new RequisitionImport($request->department),request()->file('file'));
        return back();
    }
}
