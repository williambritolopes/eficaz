<?php

namespace App\Http\Controllers;

use App\Product;
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
        $products =  Product::with('category')->paginate(10);
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

        // dd($request);
        $newproduct = $request->validate([
            'code_id'     => 'required|unique:App\Product,code_id',
            'name'        => 'required|string|min:5',
            'description' => 'required|string|min:5',
            'price'       => 'required|numeric|min:1',
            'category_id'  => 'required|numeric',
            'stock'       => 'required|numeric'
        ]);
        
        $product = new Product();
        $product->fill($newproduct);
        $product->save();
        return $product;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request ,Product $product)
    {
        $params = array( $request->query()) ;
        return $product->with('category')->where([$params])->paginate(10);;
    }   

    /**
    * Display the specified resource with params.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function showParam(Request $request,Product $product)
    {
        $params = array( $request->query()) ;
        return Product::with('category')->where([$params])->paginate(10);

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

        $newproduct = $request->validate([
            'code_id'     => 'required|unique:App\Product,code_id',
            'name'        => 'required|string|min:5',
            'description' => 'required|string|min:5',
            'price'       => 'required|numeric|min:1',
            'category_id'  => 'required|numeric',
            'stock'       => 'required|numeric'
        ]);
        
        $product = new Product();
        $product->fill($newproduct);
        $product->save();
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
            return 'Product deleted';
        }
        return 'Product not deleted!';

    }
}
