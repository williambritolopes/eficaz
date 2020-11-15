<?php

namespace App\Http\Controllers;

use App\Models\Category; 
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories =  Category::all();
        return $categories;
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validate = $request->validate([
            'name'       => 'required|string|min:5',
        ]);
        if(!$validate){
            return $validate;
        }
        $category = new Category();
        $category->fill($request->all());
        $category->save();
        $category->status()->sync($validate['status']);
        return $category;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        return $category;
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
        $validate = $request->validate([
            'name'       => 'required|string|min:5',
        ]);
        if(!$validate){
            return $validate;
        }
        $category->fill($request->all());
        $category->save();
//        $category->category()->sync($validate['category']);
        return redirect('/home/category')->with('success', 'Category updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if($category->delete()){
            return redirect('/home/category')->with('success', 'Status deleted!');
        }
        return redirect('/home/category')->with('success', 'Category not deleted!');
    }


}