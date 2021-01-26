<?php

namespace App\Http\Controllers;

use App\IStorage;
use App\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class StorageController extends Controller
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
        $storages = IStorage::latest()->get();
        $categories = Category::latest()->get();
        $object = new IStorage;
        $modelname = class_basename($object);
        return view('backend.content.storage.index', compact('storages','modelname','categories'));
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
            'location' => 'required',
            'product_category' => 'required'
        ]);

        $storage = new IStorage([
            'name' => $request->get('name'),
            'location' => $request->get('location'),
            'product_category' => $request->get('product_category')
        ]);

        $storage->save();
        toastr()->success('Storage added successfully', 'success');
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\IStorage  $storage
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $object = new IStorage;
        $modelname = class_basename($object);
        $id = Crypt::decrypt($id);
        $storage = Storage::find($id);
        return view('backend.content.storage.view', compact('storage','modelname'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\IStorage  $storage
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $object = new IStorage;
        $modelname = class_basename($object);
        $id = Crypt::decrypt($id);
        $storage = IStorage::find($id);
        $categories = Category::latest()->get();
        return view('backend.content.storage.edit', compact('storage','modelname','categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\IStorage  $storage
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $id = Crypt::decrypt($id);
        $storage = IStorage::find($id);
        
        $request->validate([
            'name' => 'required',
            'location' => 'required',
            'product_category' => 'required'
        ]);

        $storage->name = $request->get('name');
        $storage->location = $request->get('location');
        $storage->product_category = $request->get('product_category');

        $storage->save();
        toastr()->success('Storage updated successfully', 'success');
        return redirect()->route('storage.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\IStorage  $storage
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        $id = Crypt::decrypt($id);
        $storage = IStorage::find($id);
        $storage->delete();
        toastr()->error('Storage Deleted Successfully','Deleted');
        return redirect()->back();
    }
}
