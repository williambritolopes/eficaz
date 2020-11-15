<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return csrf_token();
        $products =  Product::with('category')->get();
        return $products;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        // $request->validate([
        //     'code_id'     => 'required',
        //     'name'        => 'required',
        //     'description' => 'required',
        //     'price'       => 'required',
        //     'categories'  => 'required',
        //     'stock'       => 'required'
        // ]);

        Product::create($request->all());

        return redirect()->route('products.index')
            ->with('success', 'Product created successfully.');
        
        // $product = new Product();
        // $product->fill($request);
        // $product->save();
        // $product->category()->sync($request['categories']);
        // return $product;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        return $product;
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request ,Product $product)
    {

        $validate = $request->validate([
            'name'        => 'required|string|min:5',
            'description' => 'required|min:20',
            'price'       => 'required|min:3',
            'active'  => 'required',
            'categories' => 'required' ,

        ]);

        $product->fill($validate);
        $product->save();
        $product->category()->sync($validate['categories']);

        return $product;

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        if($product->delete()){
            return redirect('/home/product')->with('success', 'Product deleted!');
        }
        return 'Product not deleted!';

    }
}
