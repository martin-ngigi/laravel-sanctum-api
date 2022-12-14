<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * GET ALL
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return Product::all();
    }

    /**
     * CREATING/POST
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // return Product::create([
        //     'name' => 'Product One',
        //     'slug' => 'Product-one',
        //     'description' => 'This is product description',
        //     'price' => '99.99',
        // ]);

        //validate data
        $request->validate([
            'name' => 'required',
            'slug' => 'required',
            'price' => 'required'
        ]);


        return Product::create($request->all());
    }

    /**
     * GETTING ONE
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        return Product::find($id);
    }

    /**
     * PUT
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $product = Product::find($id);
        $product->update($request->all());
        return $product;
    }

    /**
     * DELETE
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        return Product::destroy($id);
        //return 'Product deleted successfully';
    }

    /**
     * Summary of search by name
     * @param mixed $name
     * @return mixed
     */
    public function search($name){
        return Product::where('name','like', '%'.$name)->get();
    }

}
