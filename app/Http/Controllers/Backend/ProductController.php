<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\SubSubCategory;
use App\Models\Brand;

use App\Models\Product;
use App\Models\MultiImg;
use Carbon\Carbon;
use Image;

class ProductController extends Controller
{
    public function AddProduct()
    {
        $categories = Category::latest()->get();
        $subcategories = SubCategory::latest()->get();
        $brands = Brand::latest()->get();
        return view('backend.product.product_add', compact('categories', 'subcategories', 'brands'));
    }

    public function StoreProduct(Request $request)
    {

        $image = $request->file('product_thambnail');
        $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
        $image->move('upload/products/thambnail/', $name_gen);
        $save_url = 'upload/products/thambnail/' . $name_gen;

        $product_id = Product::insert([
            'brand_id' => $request->brand_id,
            'category_id' => $request->category_id,
            'subcategory_id' => $request->subcategory_id,
            'product_name_eng' => $request->product_name_eng,

            'product_code' => $request->product_code,
            'product_qty' => $request->product_qty,
            'product_size_eng' => $request->product_size_eng,
            'product_color_eng' => $request->product_color_eng,
            'selling_price' => $request->selling_price,
            'descp_eng' => $request->descp_eng,
            'hot_deals' => $request->hot_deals,
            'featured' => $request->featured,
            'special_offer' => $request->special_offer,
            'special_deals' => $request->special_deals,
            'product_thambnail' => $save_url,
            'status' => 1,
            'created_at' => Carbon::now(),

        ]);


        ////////// Multiple Image Upload Start ///////////

        $images = $request->file('multi_img');
        foreach ($images as $img) {
            $make_name = hexdec(uniqid()) . '.' . $img->getClientOriginalExtension();
            $img->move('upload/products/multi-image/', $make_name);
            $uploadPath = 'upload/products/multi-image/' . $make_name;


            MultiImg::insert([

                'product_id' => $product_id,
                'photo_name' => $uploadPath,
                'created_at' => Carbon::now(),  //new date shuold be inserted

            ]);


            ////////// End Multiple Image Upload Start ///////////

            $notification = array(
                'message' => 'Product Inserted Successfully',
                'alert-type' => 'success'
            );

            return redirect()->back()->with($notification);
        } // end method


    }
}
