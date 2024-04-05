<?php

namespace App\Http\Controllers;

use App\Models\product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::latest()->paginate(5);
        return view('products.index', compact('products'))->with(request()->input());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('products.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //validate the input
        $request->validate([
            'name' => 'required',
            'detail' => 'required'
        ]);

        //cretae new product
        product::create($request->all());


        //redirect user
        return redirect()->route('products.index')->with('success','Product created succesfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(product $product)
    {
         return view('products.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(product $product)
    {
        return view('products.edit',compact('product'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, product $product)
    {
        //validate the input
        $request->validate([
            'name' => 'required',
            'detail' => 'required'
        ]);

        //cretae new product
        $product->update($request->all());


        //redirect user
        return redirect()->route('products.index')->with('success','Product updated succesfully');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(product $product)
    {
        //delete the product
        $product->delete();

        //redirect
        return redirect()->route('products.index')->with('success','Product deleted succesfully');
    }
}
