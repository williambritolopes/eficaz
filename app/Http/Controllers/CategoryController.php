<?php

namespace App\Http\Controllers;

use App\Category; 
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $params = array( $request->query()) ;
        return Category::where([$params])->paginate(10);
        // return $categories;
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $newCategory = $request->validate([
            'code_id'     => 'unique:App\Category,code_id',
            'name'        => 'string|min:5',
            'description' => 'string|min:5'
        ]);
        
        $category = new Category();
        $category->fill($newCategory);
        $category->save();
        return $category;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request ,Category $category)
    {
        $params = array( $request->query()) ;
        return Category::where([$params])->paginate(10);
    } 


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        $newCategory = $request->validate([
            'code_id'     => 'required|unique:App\Category,code_id',
            'name'        => 'required|string|min:5',
            'description' => 'required|string|min:5'
        ]);
        
        $category->fill($newCategory);
        $category->save();
        return $category;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        if($category->delete()){
            return  response()->json('Category deleted!');
        }
        return response()->json('Category not deleted!');
    }


}