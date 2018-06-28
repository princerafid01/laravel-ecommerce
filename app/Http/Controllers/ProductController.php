<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;
use DB;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = [];
        $data['products'] = Product::all();
        return view('admin.manage_product' , $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = DB::table('categories')->where('publication_status',1)->get();
        $brands = DB::table('brands')->get();
        return view('admin.add_product')
                ->with('categories',$categories)
                ->with('brands',$brands);
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
            'title' => 'required|max:200',
            'description' => 'required|min:120',
            'price' => 'required',
            'img_one' => 'required|image|max:10240',
            'img_two' => 'image|max:10240',
            'img_three' => 'image|max:10240',
            'category_id' => 'required',
            'brand_id' => 'required',
        ]);



        $img_one = $request->file('img_one');
        $img_one = $img_one->store('image_path');
        $img_two = '';
        $img_three = '';
        

        if ($request->hasFile('img_two')) {
            $img_two = $request->file('img_two');
            $img_two = $img_two->store('image_path');
        }

        if ($request->hasFile('img_three')) {
            $img_three = $request->file('img_three');
            $img_three = $img_three->store('image_path');
        }
        $product_info = [
            'title' => $request->title,
            'description' => $request->description,
            'price' => $request->price,
            'img_one' => $img_one,
            'img_two' => $img_two,
            'img_three' => $img_three,
            'category_id' => $request->category_id,
            'brand_id' => $request->brand_id,
            'discounted_price' => $request->discounted_price,
        ];

        $db = Product::create($product_info);
        if ($db) {
            session()->flash('message','Product added!');
            return back();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data=[];
        $data['product'] = Product::find($id);
        $categories = DB::table('categories')->where('publication_status',1)->get();
        $brands = DB::table('brands')->get();
        return view('admin.edit_product',$data)
                ->with('categories',$categories)
                ->with('brands',$brands);
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
        $product = Product::find($id);
        $this->validate($request,[
            'title' => 'required|max:200',
            'description' => 'required|min:120',
            'price' => 'required',
            'img_one' => 'image|max:10240',
            'img_two' => 'image|max:10240',
            'img_three' => 'image|max:10240',
            'category_id' => 'required',
            'brand_id' => 'required',
        ]);



        if ($request->hasFile('img_one')) {
            $file_name = 'storage/'.$product->img_one;
            unlink($file_name);
            $img_one = $request->file('img_one');
            $img_one = $img_one->store('image_path');
        } else {
            $img_one = $product->img_one;
        }
        

        if ($request->hasFile('img_two')) {
            if ($product->img_two != '') {
                $file_name = 'storage/'.$product->img_two;
                unlink($file_name);
            }
            $img_two = $request->file('img_two');
            $img_two = $img_two->store('image_path');
        } else {
            $img_two = $product->img_two;
        }

        if ($request->hasFile('img_three')) {
            if ($product->img_three != '') {
                $file_name = 'storage/'.$product->img_three;
                unlink($file_name);
            }
            $img_three = $request->file('img_three');
            $img_three = $img_three->store('image_path');
        } else {
            $img_three = $product->img_three;
        }

        $product_info = [
            'title' => $request->title,
            'description' => $request->description,
            'price' => $request->price,
            'img_one' => $img_one,
            'img_two' => $img_two,
            'img_three' => $img_three,
            'category_id' => $request->category_id,
            'brand_id' => $request->brand_id,
            'discounted_price' => $request->discounted_price,
        ];

        $db = $product->update($product_info);
        if ($db) {
            session()->flash('message','Product edited!');
            return redirect()->route('manage-product');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::find($id);
        $file_name_01 = 'storage/'.$product->img_one;
        unlink($file_name_01);
        if ($product->img_two != '') {
            $file_name_02 = 'storage/'.$product->img_two;
            unlink($file_name_02);
        }
        if ($product->img_three != '') {
            $file_name_03 = 'storage/'.$product->img_three;
            unlink($file_name_03);
        }
        $db = $product->delete();
        if ($db) {
            session()->flash('message','Product deleted!');
            return back();
        }
    }
}
