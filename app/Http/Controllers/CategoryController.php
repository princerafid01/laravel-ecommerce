<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use DB;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = [];
        $data['categories'] = Category::all();
        return view('admin.manage_category' ,$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.add_category');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'category_name'=> 'required',
            'category_description'=> 'required',
            'publication_status'=> 'required',
        ]);

        $db = Category::create([
            'category_name'=> trim($request->category_name),
            'category_description'=> trim($request->category_description),
            'publication_status'=> trim($request->publication_status),
        ]);
        if ($db) {
            session()->flash('message','Added Category');
            return redirect()->back();        
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category = Category::find($id);
        return view('admin.edit_category')->with('category', $category);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request,[
            'category_name' => 'required',
            'category_description' => 'required',
            'publication_status' => 'required',
        ]);
        $request = $request->except('_token');
        $db = Category::whereId($id)->update($request);
        if ($db) {
            session()->flash('message', 'Category Updated!');  
            return redirect()->route('admin.manage.category');          
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = Category::find($id);
        DB::table('products')->where('category_id', $id)->delete();
        
        $db = $category->delete();
        if ($db) {
            session()->flash('message', 'Category deleted!');  
            return back();          
        }

    }

    public function unpublish($id)
    {
        $category = Category::find($id);
        $category->publication_status = 0;
        if ($category->save()) {
            session()->flash('message', 'Category unpublished');
            return redirect()->back();
        }
    }

    public function publish($id)
    {
        $category = Category::find($id);
        $category->publication_status = 1;
        if ($category->save()) {
            session()->flash('message', 'Category published');
            return redirect()->back();
        }
    }
}
