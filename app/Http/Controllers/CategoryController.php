<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class CategoryController extends Controller
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
        $object = new Category;
        $modelname = class_basename($object);
        $categories = Category::latest()->get();
        return view('backend.content.category.index', compact('categories','modelname'));
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
            'category_name' => 'required'
        ]);

        $category = new Category([
            'category_name' => $request->get('category_name')
        ]);

        $category->save();
        toastr()->success('Category added successfully','Success');
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $object = new Category;
        $modelname = class_basename($object);
        $id = Crypt::decrypt($id);
        $category = Category::find($id);
        return view('backend.content.category.edit', compact('category','modelname'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'category_name' => 'required'
        ]);

        $id = Crypt::decrypt($id);
        $category = Category::find($id);
        
        $category->category_name = $request->get('category_name');

        $category->save();
        toastr()->success('Category updated successfully','Success');
        return redirect()->route('category.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        $id = Crypt::decrypt($id);
        $category = Category::find($id);
        $category->delete();
        toastr()->error('Category Deleted Successfully','Deleted');
        return redirect()->back();
    }
}
