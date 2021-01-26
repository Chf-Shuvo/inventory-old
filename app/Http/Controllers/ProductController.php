<?php

namespace App\Http\Controllers;

use App\Product;
use App\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\File;

class ProductController extends Controller
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
        $products = Product::latest()->get();
        $categories = Category::latest()->get();
        $object = new Product;
        $modelname = class_basename($object);
        return view('backend.content.product.index', compact('products','modelname','categories'));
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
        $request->validate([
            'name' => 'required',
            'category' => 'required',
            'brand' => 'required'
        ]);
        
        $check = Product::where('name',$request['name'])->count();
    
        if($check > 0){
             toastr()->error('Duplicate Product Found with this name, please do not add any product with the same name. This portion is for generic products only.', 'Error');
             return redirect()->back();
        }
        $product = new Product([
            'name' => $request->get('name'),
            'category' => $request->get('category'),
            'brand' => $request->get('brand')
        ]);
        // last item
        $last = Product::latest()->first();
        // generating the code
        if(empty($last)){
            $this_code = 1;
        }else{
            $this_code = $last->id+1;
        }
        $product->code = 'BP'.'-'.$this_code;
        $product->save();
        toastr()->success('Product added successfully', 'success');
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $object = new Product;
        $modelname = class_basename($object);
        $id = Crypt::decrypt($id);
        $product = Product::find($id);
        return view('backend.content.product.view', compact('product','modelname'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $object = new Product;
        $modelname = class_basename($object);
        $id = Crypt::decrypt($id);
        $product = Product::find($id);
        $categories = Category::latest()->get();
        return view('backend.content.product.edit', compact('product','modelname','categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $id = Crypt::decrypt($id);
        $product = Product::find($id);
        
        $request->validate([
            'name' => 'required',
            'category' => 'required',
            'brand' => 'required'
        ]);

        $product->name = $request->get('name');
        $product->category = $request->get('category');
        $product->brand = $request->get('brand');
        $product->code = $request->get('code');

        $product->save();
        toastr()->success('Product updated successfully', 'success');
        return redirect()->route('product.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        $id = Crypt::decrypt($id);
        $product = Product::find($id);
        $product->delete();
        toastr()->error('Product Deleted Successfully','Deleted');
        return redirect()->back();
    }
}
