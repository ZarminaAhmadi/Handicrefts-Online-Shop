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

            return redirect()->route('manage-product')->with($notification);
        } // end method


    }

    public function ManageProduct()
    {

        $products = Product::latest()->get();
        return view('backend.product.product_view', compact('products'));
    }

    public function EditProduct($id)
    {
        $multiImgs = MultiImg::where('product_id', $id)->latest()->get();

        $categories = Category::latest()->get();
        $brands = Brand::latest()->get();
        $subcategory = SubCategory::latest()->get();
        $products = Product::findOrFail($id);
        return view('backend.product.product_edit', compact('categories', 'brands', 'subcategory', 'products', 'multiImgs'));
    }

    public function ProductDataUpdate(Request $request)
    {

        $product_id = $request->id;

        $product_id = Product::findOrFail($product_id)->update([
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
            'status' => 1,
            'created_at' => Carbon::now(),

        ]);

        $notification = array(
            'message' => 'Product Updated Without Image Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('manage-product')->with($notification);
    } // end method


    /// Multiple Image Update
    public function MultiImageUpdate(Request $request)
    {
        $img = $request->all();

        foreach ($img as $imgs) {
            $imgDel = MultiImg::findOrFail('id');
            unlink($imgDel->photo_name);

            $make_name = hexdec(uniqid()) . '.' . $imgs->getClientOriginalExtension();
            $imgs->move('upload/products/multi-image/', $make_name);
            $uploadPath = 'upload/products/multi-image/' . $make_name;

            MultiImg::where('id')->update([
                'photo_name' => $uploadPath,
                'updated_at' => Carbon::now(),

            ]);
        } // end foreach

        $notification = array(
            'message' => 'Product Image Updated Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    } // end mehtod



    /// Product Main Thambnail Update ///
    public function ThambnailImageUpdate(Request $request)
    {
        $pro_id = $request->id;
        $oldImage = $request->old_img;
        unlink($oldImage);

        $image = $request->file('product_thambnail');
        $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
        $image->move('upload/products/thambnail/', $name_gen);
        $save_url = 'upload/products/thambnail/' . $name_gen;



        Product::findOrFail($pro_id)->update([
            'product_thambnail' => $save_url,
            'updated_at' => Carbon::now(),

        ]);

        $notification = array(
            'message' => 'Product Image Thambnail Updated Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    } // end method


    //// Multi Image Delete ////
    public function MultiImageDelete($id)
    {
        $oldimg = MultiImg::findOrFail($id);
        unlink($oldimg->photo_name);
        MultiImg::findOrFail($id)->delete();

        $notification = array(
            'message' => 'Product Image Deleted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    } // end method




    public function ProductInactive($id)
    {
        Product::findOrFail($id)->update(['status' => 0]);
        $notification = array(
            'message' => 'Product Inactive',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }


    public function ProductActive($id)
    {
        Product::findOrFail($id)->update(['status' => 1]);
        $notification = array(
            'message' => 'Product Active',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }


    public function ProductDelete($id)
    {
        $product = Product::findOrFail($id);
        unlink($product->product_thambnail);
        Product::findOrFail($id)->delete();

        $images = MultiImg::where('product_id', $id)->get();
        foreach ($images as $img) {
            unlink($img->photo_name);
            MultiImg::where('product_id', $id)->delete();
        }

        $notification = array(
            'message' => 'Product Deleted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    } // end method
}
