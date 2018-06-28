<?php

namespace App\Http\Controllers;

use App\Brand;
use DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data= [];
        $data['brands'] = Brand::all();
        return view('admin.manage_brand', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.add_brand');
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
            'name' => 'required',
            'image_path' => 'required|image|max:10240'
        ]);
        $image_path = $request->file('image_path');
        $image_path = $image_path->store('image_path');

        $db = Brand::create([
            'name' => $request->name,
            'image_path' => $image_path,
        ]);
        if ($db) {
            session()->flash('message', 'Brand name created succesfully.');
            return redirect()->back();
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function show(Brand $brand)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data =[];
        $data['brand'] = Brand::find($id);
        return view('admin.edit_brand',$data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,  $id)
    {
        $brand = Brand::find($id);
        $this->validate($request,[
            'name' => 'required',
            'image_path' => 'image|max:10240'
        ]);
        $image_path = $brand->image_path;
        if ($request->hasFile('image_path')) {
            $file_name = 'storage/'.$brand->image_path;
            unlink($file_name);
            $image_path = $request->file('image_path');
            $image_path = $image_path->store('image_path');
            // $file_name = Storage::url(trim($brand->image_path,'image_path/'));
            // if(File::exists($file_name)) {
            //     File::delete($file_name);
            // }

        }
        
        $db = $brand->update([
            'name' => $request->name,
            'image_path' => $image_path,
        ]);
        if ($db) {
            session()->flash('message', 'Brand name edited succesfully.');
            return redirect()->route('manage-brand');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $brand = Brand::find($id);
        DB::table('products')->where('brand_id', $id)->delete();

        $db = $brand->delete();
        $file_name = 'storage/'.$brand->image_path;
        unlink($file_name);
        if ($db) {
            session()->flash('message', 'Brand name deleted succesfully.');
            return redirect()->route('manage-brand');
        }
    }
}
