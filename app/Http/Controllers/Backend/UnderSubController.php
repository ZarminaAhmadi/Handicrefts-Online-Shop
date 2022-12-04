<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\SubCategory;
use App\Models\UnderSubCategory;
use Illuminate\Http\Request;

class UnderSubController extends Controller
{

    public function UnderSubCategoryView()
    {
        $under_sub = UnderSubCategory::all();
        $subcategory = SubCategory::orderBy('subcategory_name_eng', 'ASC')->get();
        // $subcategory = SubCategory::latest()->get();
        return view('backend.category.under_subcategory', compact('under_sub', 'subcategory'));
    }

    public function SubCategoryStore(Request $request)
    {

        $request->validate([
            'name' => 'required',
            'sub_category_id' => 'required'


        ], [
            'sub_category_id.required' => 'Please select Any option',
            'name.required' => 'Input UnderSubCategory English Name',

        ]);



        UnderSubCategory::insert([
            'sub_category_id' => $request->sub_category_id,
            'name' => $request->name,


        ]);

        $notification = array(
            'message' => 'UnderSubCategory Inserted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    } // end method



    public function UnderSubCategoryEdit($id)
    {
        $categories = subCategory::orderBy('name', 'ASC')->get();
        $subcategory = SubCategory::findOrFail($id);
        return view('backend.category.under_subcategory_edit', compact('subcategory', 'categories'));
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
