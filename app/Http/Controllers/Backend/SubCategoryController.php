<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SubCategory;
use App\Models\Category;
use App\Models\SubSubCategory;

class SubCategoryController extends Controller
{
    public function SubCategoryView()
    {
        $subcategory = SubCategory::with('category')->get();
        $categories = Category::orderBy('category_name_eng', 'ASC')->get();
        $subcategory = SubCategory::latest()->get();
        return view('backend.category.subcategory_view', compact('subcategory', 'categories'));
    }

    public function SubCategoryStore(Request $request)
    {

        $request->validate([
            'subcategory_name_eng' => 'required',
            'gender' => 'required',
            'category_id' => 'required'


        ], [
            'category_id.required' => 'Please select Any option',
            'subcategory_name_eng.required' => 'Input SubCategory English Name',

            'gender.required' => "please fill the gender Fields"
        ]);



        SubCategory::insert([
            'category_id' => $request->category_id,
            'subcategory_name_eng' => $request->subcategory_name_eng,
            'gender' => $request->gender,



        ]);

        $notification = array(
            'message' => 'SubCategory Inserted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    } // end method



    public function SubCategoryEdit($id)
    {
        $categories = Category::orderBy('category_name_eng', 'ASC')->get();
        $subcategory = SubCategory::findOrFail($id);
        return view('backend.category.subcategory_edit', compact('subcategory', 'categories'));
    }

    public function SubCategoryUpdate(Request $request)
    {

        $subcat_id = $request->id;

        SubCategory::findOrFail($subcat_id)->update([
            'category_id' => $request->category_id,
            'subcategory_name_eng' => $request->subcategory_name_eng,
            'gender' => $request->gender



        ]);

        $notification = array(
            'message' => 'SubCategory Updated Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('all.subcategory')->with($notification);
    }  // end method



    public function SubCategoryDelete($id)
    {

        SubCategory::findOrFail($id)->delete();

        $notification = array(
            'message' => 'SubCategory Deleted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }

    /////////////// That for SUB SUBCATEGORY  //////////////


    public function GetSubCategory($category_id)
    {

        $subcat = SubCategory::where('category_id', $category_id)->orderBy('subcategory_name_eng', 'ASC')->get();
        return json_encode($subcat);
    }
}
