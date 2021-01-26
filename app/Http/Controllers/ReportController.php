<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Http\Request;
use App\Department;
use App\Requisition_Temp;
use App\DlProduct;
class ReportController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
// by department
    public function dept_index(){
        $departments = Department::where('type','department')->get();
        return view('backend.content.reports.byDept.index', compact('departments'));
    }

    public function dept_view($id){
        $id = Crypt::decrypt($id);
        $d_requisitions = Requisition_Temp::where('department',$id)->get();
        return view('backend.content.reports.byDept.view', compact('d_requisitions'));
    }

    public function dept_product_view($id){
        $id = Crypt::decrypt($id);
        $products = DlProduct::where('requisition_id', $id)->get();
        return view('backend.content.reports.byDept.products',compact('products'));
    }
// by laboratory
    public function lab_index(){
        $labs = Department::where('type','lab')->get();
        return view('backend.content.reports.byLab.index', compact('labs'));
    }

    public function lab_view($id){
        $id = Crypt::decrypt($id);
        $l_requisitions = Requisition_Temp::where('lab_id',$id)->get();
        return view('backend.content.reports.byLab.view', compact('l_requisitions'));
    }

    public function lab_product_view($id){
        $id = Crypt::decrypt($id);
        $products = DlProduct::where('requisition_id', $id)->get();
        return view('backend.content.reports.byDept.view',compact('products'));
    }
}
