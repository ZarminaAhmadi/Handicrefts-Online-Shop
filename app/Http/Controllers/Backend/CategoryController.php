<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    public function __constract()
    {
        $this->middleware(['auth','admin']);
    }

    public function CategoryView()
    {
        $category = Category::latest()->get();
        return view('backend.category.category_view', compact('category'));
    }
    public function CategoryStore(Request $request)
    {
        $request->validate([
            'category_name_eng' => 'required',

            'category_icon' => 'required',
        ], [
            'category_name_eng.required' => 'Inpute Category English Name',


        ]);


        Category::insert([
            'category_name_eng' => $request->category_name_eng,

            'category_icon' => $request->category_icon,
        ]);
        $notification = array(
            'message' => 'Category Inserted Successfully',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    } //end method

    public function CategorydEdit($id)
    {
        $category = Category::findOrFail($id);   //with this model we git spesific one row data from category table of DB
        return view('backend.category.category_edit', compact('category')); //we pass here the data that wr get from DB
    }

    public function CategorydUpdate(Request $request, $id)
    {

        Category::findOrFail($id)->Update([
            'category_name_eng' => $request->category_name_eng,

            'category_icon' => $request->category_icon,
        ]);
        $notification = array(
            'message' => 'Category Updated Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('all.category')->with($notification);
    } // end method

    public function CategoryDelete($id)
    {

        Category::findOrFail($id)->delete();

        $notification = array(
            'message' => 'Category Deleted Successfully',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    } // end method
}
