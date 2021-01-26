<?php

namespace App\Http\Controllers;

use App\Stock;
use App\Vendor;
use App\Product;
use App\Category;
use App\IStorage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Http\File;
use Illuminate\Support\Facades\Storage;

class StockController extends Controller
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
        $products = Product::all();
        $categories = Category::latest()->get();
        $object = new Stock;
        $modelname = class_basename($object);
        return view('backend.content.stock.index', compact('products','categories','modelname','categories'));
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
            'product_id' => 'required',
            'product_code' => 'required',
            'vendor' => 'required',
            'quantity' => 'required',
            'unit' => 'required',
            'price' => 'required',
            'date' => 'required',
            'storage' => 'required'
        ]);

        $stock = new Stock([
            'product_id' => $request->get('product_id'),
            'product_code' => $request->get('product_code'),
            'vendor' => $request->get('vendor'),
            'quantity' => $request->get('quantity'),
            'unit' => $request->get('unit'),
            'price' => $request->get('price'),
            'date' => $request->get('date'),
            'storage' => $request->get('storage')
        ]);
        $stock->note = $request['note'];

        // /** Collecting informations for QR Code */

        // $product = Product::find($request->get('product'));
        // $vendor = Vendor::find($request->get('vendor'));

        // $image = \QrCode::format('png')
        //         ->size(200)
        //         ->generate('Name: '.$product->name."\r\n"."Brand: ".$product->brand."\r\n"."Color: ".$product->color."\r\n"."Price: ".$product->price."\r\n"."Vendor: ".$vendor->name);
        // $output_file = 'QRcodes/img-' . time() . '.png';
        // Storage::disk('public')->put($output_file, $image); 

        // $stock->note = $request->get('note');
        
        // $stock->qrcode = $output_file;

        $stock->save();
        toastr()->success('Success','Stock in successfully');
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Stock  $stock
     * @return \Illuminate\Http\Response
     */
    public function show(Stock $stock)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Stock  $stock
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        
        $object = new Stock;
        $modelname = class_basename($object);
        $id = Crypt::decrypt($id);
        $stock = Stock::find($id);
        $vendors = Vendor::latest()->get();
        $storages = IStorage::latest()->get();
        return view('backend.content.stock.edit', compact('stock','modelname','vendors','storages'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Stock  $stock
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'vendor' => 'required',
            'quantity' => 'required',
            'price' => 'required',
            'date' => 'required',
            'storage' => 'required'
        ]);
        
        $id = Crypt::decrypt($id);
        $stock = Stock::find($id);
        $stock->vendor = $request->get('vendor');
        $stock->quantity = $request->get('quantity');
        $stock->unit = $request->get('unit');
        $stock->price = $request->get('price');
        $stock->date = $request->get('date');
        $stock->storage = $request->get('storage');
        $stock->note = $request->get('note');

        $stock->save();
        toastr()->success('Success','Stock updated successfully');
        return redirect()->route('stock.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Stock  $stock
     * @return \Illuminate\Http\Response
     */
    public function delete($id){
        $id = Crypt::decrypt($id);
        $stock = Stock::find($id);
        $stock->delete();
        toastr()->error('Stock Removed!','Removed');
        return redirect()->back();
    }
    public function product_stock($id)
    {
        $object = new Stock;
        $modelname = class_basename($object);
        $product_id = Crypt::decrypt($id);
        $stocks = Stock::where('product_id','=',$product_id)->get();
        return view('backend.content.stock.product-stock', compact('stocks','modelname','product_id'));   
    }
}
