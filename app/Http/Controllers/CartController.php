<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Brand;
use App\Category;
Use Cart;

class CartController extends Controller
{



    public function ProcessCart(Request $request)
    {
        $data = [];
        $data['id'] = $request->id;
        $data['name'] = $request->name;
        $data['qty'] = $request->qty;
        $data['price'] = $request->amount;
        $data['options']['image'] = Product::find($request->id)->img_one;
        Cart::add($data);
        session()->flash('success', 'Product added to cart!');
        return redirect()->back();
    }

    public function ShowCart()
    {
        $data = [];
        $data['cart'] = Cart::content();
        return view('cart', $data);
    }

    public function UpdateCart(Request $request)
    {
        Cart::update($request->rowId, $request->qty);
        return back();
    }

    public function UpdateCartIncrease($rowId, $qty)
    {
        Cart::update($rowId, $qty + 1);
        return back();
    }

    public function UpdateCartDecrease($rowId, $qty)
    {
        Cart::update($rowId, $qty - 1);
        return back();
    }

    public function DeleteCart($rowId)
    {
        Cart::remove($rowId);
        return back();
    }

    public function ClearCart()
    {
        Cart::destroy();
        return redirect()->back();
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
