<?php

namespace App\Http\Controllers;
use App\DlProduct;
use App\Requisition_Temp;
use App\Product;
use App\Department;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use DB;
class Transfer extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(){
        $products = DB::table('dl_products')
                        ->join('requisition__temps','dl_products.requisition_id','=','requisition__temps.id')
                        ->join('products','dl_products.product_id','=','products.id')
                        ->select('dl_products.id','dl_products.quantity','dl_products.requisition_id','requisition__temps.receiver','requisition__temps.updated_at','requisition__temps.department','products.name','products.code')
                        ->get();
        $modelname = "Internal-Transfer";
        // return $products;
        return view('backend.content.transfer.index',compact('products','modelname'));
    }

    // transfer process
    public function transfer_process($id){
        $id = Crypt::decrypt($id);
        $transfer = DlProduct::find($id);
        $product = Product::find($transfer->product_id);
        $requisition = Requisition_Temp::find($transfer->requisition_id);
        $modelname = "Transfer Process";
        $newReq = Requisition_Temp::where('app_head','=','1')
                                        ->where('app_dpr','=','1')
                                        ->where('app_r','=','1')
                                        ->where('delivery_status','=','0')
                                        ->get();
        return view('backend.content.transfer.process',compact('transfer','product','requisition','modelname','newReq'));
    }
    // transfer execution
    public function transfer_execute(Request $request, $id){
        $id = Crypt::decrypt($id);
        // assigning to delivery
        $deliver = new DlProduct([
            'requisition_id' => $request['requisition_id'],
            'product_id' => $request['product_id'],
            'quantity' => $request['quantity']
        ]);
        $deliver->save();

        // updating current invoice
        $current = DlProduct::find($id);
        if($current->quantity > $request['quantity']){
            $current->quantity = $current->quantity - $request['quantity'];
            $current->save();
            toastr()->success('Transfer Complete','Success');
        }else{
            $current->delete();
            toastr()->success('Transfer Complete and product removed from other department','Success');
        }
        return redirect()->route('approved.final');
    }
}
