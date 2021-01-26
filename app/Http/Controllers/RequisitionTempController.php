<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Crypt;
use App\Requisition_Temp;
use App\Requisition;
use App\RqProducts;
use App\Department;
use App\DlProduct;
use Illuminate\Http\Request;
use Mail;
use \App\Mail\SendEmail;
use Auth;
use App\User;
class RequisitionTempController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $object = new Requisition_Temp;
        $modelname = class_basename($object);
        $requisitions = Requisition_Temp::where('department','=',Auth::user()->department)->latest()->get();
        return view('backend.content.requisition.submit', compact('requisitions','modelname'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //return $request;
        $request->validate([
            'department'=>'required',
            'submittedBy'=>'required',
            'product'=>'required|array|min:1',
            'quantity'=>'required|array|min:1',
            'lab_id'=>'required'
        ]);
        $req_temp = new Requisition_Temp([
            'department'=>$request->get('department'),
            'submittedBy'=>$request->get('submittedBy')
        ]);
        $req_temp->lab_id = $request['lab_id'];
        $req_temp->app_head='0';
        $req_temp->app_dpr='0';
        $req_temp->app_r='0';
        $req_temp->delivery_status='0';
        $req_temp->save();
        
        $req_id = Requisition_Temp::all()->last();
        $req_id = $req_id->id;
   
        $products = $request->get('product');
        $quantities = $request->get('quantity');
        foreach( $products as $index=>$product ){
            $req_product = new RqProducts([
                'requisition_id'=>$req_id,
                'product_id'=>$product,
                'quantity'=>$quantities[$index]
            ]);
            $req_product->save();
        }
        // finding head for sending email
        $this_user= Auth::user();
        $head = User::where('department',$this_user->department)
                    ->where('type','head')
                    ->where('email','!=',$this_user->email)
                    ->first();
        // sending email
        $subject="Requsition Submitted";
        $message = 'Dear Sir, a Requisition has been placed from ICT WING by '.$this_user->name.', which is waiting for your kind approval. Please Login into Baiust Inventory Management System using your credentials to approve the requisition. (BIMS - Developed By ICT WING)';
        $user_mail = $head->email;
        Mail::to($user_mail)->send(new SendEmail($subject,$message));
        // email sent
        toastr()->success('Requisition Successfully Submitted','Success');
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Requisition_Temp  $requisition_Temp
     * @return \Illuminate\Http\Response
     */
    public function show(Requisition_Temp $requisition_Temp)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Requisition_Temp  $requisition_Temp
     * @return \Illuminate\Http\Response
     */
    public function edit(Requisition_Temp $requisition_Temp)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Requisition_Temp  $requisition_Temp
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Requisition_Temp $requisition_Temp)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Requisition_Temp  $requisition_Temp
     * @return \Illuminate\Http\Response
     */
    public function destroy(Requisition_Temp $requisition_Temp)
    {
        //
    }
    // approve files
    public function approve_index(){
        $object = new Requisition;
        $modelname = class_basename($object);
        $requisitions_pen = Requisition_Temp::latest()->get();
        //return $requisitions_app;
        return view('backend.content.requisition.approve', compact('requisitions_pen','requisitions_app','modelname'));
    }
    // for checking the requisition slip before confirming
    public function approve_confirm($id){
        $id = Crypt::decrypt($id);
        $req_pen = Requisition_Temp::find($id);
        $req_products = RqProducts::where('requisition_id','=',$id)->get();
        return view('backend.content.requisition.req_confirm', compact('req_pen','req_products'));
    }
    // the head is removing any product from the slip if necessary
    public function approve_product_remove($id){
        $id = Crypt::decrypt($id);
        $product=RqProducts::find($id);
        $product->delete();
        toastr()->error('Product Removed from the list','Removed');
        return redirect()->back();
    }
    // the head is adding products if necessary
    public function approve_product_add(Request $request){
        $products = $request->get('product');
        $quantities = $request->get('quantity');
        foreach( $products as $index=>$product ){
            $req_product = new RqProducts([
                'requisition_id'=>$request->get('requisition_id'),
                'product_id'=>$product,
                'quantity'=>$quantities[$index]
            ]);
            $req_product->save();
        }
        toastr()->success('Requisition Successfully Submitted','Success');
        return redirect()->back();
    }
    // the head finally submitting the requisition slip
    public function approve_head($id){
        $id = Crypt::decrypt($id);
        $requisition = Requisition_Temp::find($id);
        // giving the approval
        $requisition->app_head = '1';
        $requisition->save();
        toastr()->success('Approval Given','Approved');
        return redirect()->route('submit.approve_index');
    }
    // the deputy giving approval
    public function approve_deputy($id){
        $id = Crypt::decrypt($id);
        $requisition = Requisition_Temp::find($id);
        // giving the approval
        $requisition->app_dpr = '1';
        $requisition->save();
        toastr()->success('Approval Given','Approved');
        return redirect()->back();
    }
    // the registrar giving approval
    public function approve_registrar($id){
        $id = Crypt::decrypt($id);
        $requisition = Requisition_Temp::find($id);
        // giving the approval
        $requisition->app_r = '1';
        $requisition->save();
        toastr()->success('Approval Given','Approved');
        return redirect()->back();
    }
    // collecting the final requisitions
    public function final(){
        $requisitions_app = Requisition_Temp::where('app_head','=','1')
                                        ->where('app_dpr','=','1')
                                        ->where('app_r','=','1')
                                        ->where('delivery_status','=','0')
                                        ->get();

        $requisitions_delivered = Requisition_Temp::where('app_head','=','1')
                                        ->where('app_dpr','=','1')
                                        ->where('app_r','=','1')
                                        ->where('delivery_status','=','1')
                                        ->get();
        return view('backend.content.requisition.final',compact('requisitions_app','requisitions_delivered'));
    }
    // viewing the requisitions (each single)
    public function req_view($id){
        $id = Crypt::decrypt($id);
        $requisition = Requisition_Temp::find($id);
        $department = Department::find($requisition->department);
        // $pRequisitions = Requisition_Temp::where('department',$department->id)->pluck('id');
        // $pProducts = DlProduct::whereIn('requisition_id',$pRequisitions)->get();
        // return $pProducts;
        $req_products = RqProducts::where('requisition_id','=',$id)->get();
        return view('backend.content.requisition.requisition_view',compact('requisition','req_products','department'));
    }
    // delivering the requisition and preparing the invoice
    public function req_deliver($id){
        $id = Crypt::decrypt($id);
        $requisition = Requisition_Temp::find($id);
        // assigning delivery values
        $requisition->delivery_status='1';
        $requisition->delivered_by=Auth::user()->name;
        $requisition->save();
        toastr()->success('Requested Products Delivered','Delivered');
        return redirect()->back();
    }
    // finally receiving the requisition
    public function final_receive($id){
        $id = Crypt::decrypt($id);
        $requisition = Requisition_Temp::find($id);
        $requisition->receiver = Auth::user()->name;
        $requisition->save();
        toastr()->success('Product Received','Success');
        return redirect()->back();
    }
}
