<?php

namespace App\Http\Controllers;

use App\Vendor;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Http\Request;

class VendorController extends Controller
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
        $vendors = Vendor::latest()->get();
        $object = new Vendor;
        $modelname = class_basename($object);
        return view('backend.content.vendor.index', compact('vendors','modelname'));
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
            'name' => 'required',
            'address' => 'required'
        ]);

        $vendor = new Vendor([
            'name' => $request->get('name'),
            'address' => $request->get('address')
        ]);
        $vendor->email = $request->get('email');
        $vendor->contact_person = $request->get('contact_person');
        $vendor->contact_person_phone = $request->get('contact_person_phone');
        $vendor->phone = $request->get('phone');

        $vendor->save();
        toastr()->success('Vendor Added Successfully','Success');
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Vendor  $vendor
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // return $id;
        $object = new Vendor;
        $modelname = class_basename($object);
        $id = Crypt::decrypt($id);
        $vendor = Vendor::find($id);
        return view('backend.content.vendor.view', compact('vendor','modelname'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Vendor  $vendor
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $object = new Vendor;
        $modelname = class_basename($object);
        $id = Crypt::decrypt($id);
        $vendor = Vendor::find($id);
        return view('backend.content.vendor.edit', compact('vendor','modelname'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Vendor  $vendor
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //return $request;
        $request->validate([
            'name' => 'required',
            'address' => 'required'
        ]);

        $id = Crypt::decrypt($id);
        $vendor = Vendor::find($id);
        
        $vendor->name = $request->get('name');
        $vendor->email = $request->get('email');
        $vendor->contact_person = $request->get('contact_person');
        $vendor->contact_person_phone = $request->get('contact_person_phone');
        $vendor->phone = $request->get('phone');
        $vendor->address = $request->get('address');

        $vendor->save();
        toastr()->success('Vendor Updated Successfully','Success');
        return redirect()->route('vendor.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Vendor  $vendor
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        $id = Crypt::decrypt($id);
        $vendor = Vendor::find($id);
        $vendor->delete();
        toastr()->error('Vendor Deleted Successfully','Deleted');
        return redirect()->back();
    }
}
