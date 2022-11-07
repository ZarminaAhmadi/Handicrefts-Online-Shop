<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    public function CategoryView(){
         $category = Category::latest()->get();    
        return view('backend.category.category_view',compact('category'));

    }
    public function CategoryStore(Request $request){
        $request->validate([
         'category_name_eng' =>'required',
         'category_name_dari' =>'required',
         'category_icon' =>'required',
      ],[
         'category_name_eng.required' =>'Inpute Category English Name',
         'category_name_dari.required' =>'Inpute Category Dari Name',

      ]);
      

      Category::insert([
         'category_name_eng' =>$request->category_name_eng,
         'category_name_dari' =>$request->category_name_dari,
         'category_slug_eng' =>$request->category_name_eng,
         'category_slug_dari' =>$request->category_name_dari,
         'category_icon' =>$request->category_icon,
      ]);
      $notification = array(
         'message' => 'Category Inserted Successfully',
         'alert-type' =>'success'
      );
      return redirect()->back()->with($notification); 
    } //end method
}
