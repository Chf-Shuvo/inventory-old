<?php

namespace App\Http\Controllers;

use App\Invoice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use App\DlProduct;
use App\Requisition_Temp;
use App\Stock;
use App\Product;
class InvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $invoices = Invoice::latest()->get();
        $object = new Invoice;
        $modelname = class_basename($object);
        return view('backend.content.invoice.index',compact('invoices','modelname'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $id = Crypt::decrypt($id);
        return view('backend.content.invoice.create',compact('id'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // checking if invoice already generated
        $check = Invoice::where('reqID',$request['reqID'])->first();
        if(!empty($check)){
            toastr()->error('Invoice already generated','Match requisition number with invoice number here');
            return redirect()->route('invoice.index');
        }
        // generating new invoice
        $request->validate([
            'reqID'=>'required',
            'product'=>'required|array|min:1',
            'quantity'=>'required|array|min:1'
        ]);
        $invoice = new Invoice([
            'reqID'=>$request->get('reqID')
        ]);
        $invoice->remarks = $request['remarks'];
        // assigning products to delivery products table
        $products = $request->get('product');
        $quantities = $request->get('quantity');
        // at first checking all products stock
        foreach( $products as $index=>$product ){
            // checking current stock of the product
            $cStock = Stock::where('product_id',$product)->first();
            // deliver if quantity is max
            if($cStock->quantity < $quantities[$index]){
                $this_product = Product::find($product);
                toastr()->error('Stock Shortage of '.$this_product->name,'Error');
                return redirect()->back();
            }
        }
        foreach( $products as $index=>$product ){
            $req_product = new DlProduct([
                'requisition_id'=>$request->get('reqID'),
                'department' => $request['department'],
                'product_id'=>$product,
                'quantity'=>$quantities[$index]
            ]);
            // reduce current stock 
            $cStock->quantity = $cStock->quantity - $quantities[$index];
            $cStock->save();
            $req_product->save();
        }
        $invoice->save();
        toastr()->success('Requisition Successfully Submitted','Success');
        return redirect()->route('invoice.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Invoice  $invoice
     * @return \Illuminate\Http\Response
     */
    public function show(Invoice $invoice)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Invoice  $invoice
     * @return \Illuminate\Http\Response
     */
    public function edit(Invoice $invoice)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Invoice  $invoice
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Invoice $invoice)
    {
        return $request;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Invoice  $invoice
     * @return \Illuminate\Http\Response
     */
    public function destroy(Invoice $invoice)
    {
        //
    }
    // check invoice before printing
    public function check($id){
        $id = Crypt::decrypt($id);
        $invoice = Invoice::find($id);
        $requisition = Requisition_temp::find($invoice->reqID);
        $products = DlProduct::where('requisition_id','=',$invoice->reqID)->get();
        return view('backend.content.invoice.invoice_check',compact('invoice','requisition','products'));
    }
    // print invoice
    public function print(Request $request, $id){
        $id = Crypt::decrypt($id);
        $invoice = Invoice::find($id);
        $invoice->receiver = $request['receiver'];
        $invoice->save();
        $requisition = Requisition_temp::find($invoice->reqID);
        $products = DlProduct::where('requisition_id','=',$invoice->reqID)->get();
        return view('backend.content.invoice.invoice',compact('invoice','requisition','products'));
    }
}
