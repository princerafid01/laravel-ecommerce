<?php

namespace App\Http\Controllers;
use App\Product;
use App\Brand;
use App\Category;
use Cart;

use Illuminate\Http\Request;

class IndexController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data=[];
        $data['products']=Product::orderBy('id','desc')
                                    ->take(4)
                                    ->get();
        $brands = Brand::all();
        $categories = Category::orderBy('id','desc')
                        ->take(5)
                        ->get();
        return view('index',$data)
                    ->with('brands',$brands)
                    ->with('categories',$categories);
    }

    public function SingleProduct($id)
    {
        $data = [];
        $data['product'] = Product::find($id);
        // $data['rowId'] = Cart::search(['id'=> $id])->rowId;
        $category= Category::find( $data['product']->category_id);
        return view('product',$data)->with('category',$category);        
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
        //
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
