<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Brand;
use Image;

class BrandController extends Controller
{
     public function BrandView(){
        $brands = Brand::latest()->get();    
        return view('backend.brand.brand_view',compact('brands'));

     }

     public function BrandStore(Request $request){
      $request->validate([
         'brand_name_eng' =>'required',
         'brand_name_dari' =>'required',
         'brand_image' =>'required',
      ],[
         'brand_name_eng.required' =>'Inpute Brand English Name',
         'brand_name_dari.required' =>'Inpute Brand Dari Name',

      ]);
      $image = $request->file('brand_image');
      $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
      $image->move('upload/brand/',$name_gen);
      $save_url = 'upload/brand/'.$name_gen;

      Brand::insert([
         'brand_name_eng' =>$request->brand_name_eng,
         'brand_name_dari' =>$request->brand_name_dari,
         'brand_slug_eng' =>$request->brand_name_eng,
         'brand_slug_dari' =>$request->brand_name_dari,
         'brand_image' =>$save_url,
      ]);
      $notification = array(
         'message' => 'Brand Inserted Successfully',
         'alert-type' =>'success'
      );
      return redirect()->back()->with($notification); 

     } //end method

     public function BrandEdit($id){
         $brand = Brand::findOrFail($id);   //with this model we git spesific one row data from brand table of DB
         return view('backend.brand.brand_edit',compact('brand')); //we pass here the data that wr get from DB

     }

     public function BrandUpdate(Request $request){
         $barand_id = $request->id;     // $barand_id is the that id that is in url when we change brand image
         $old_img = $request->old_image;

         if($request->file('brand_image')){
        // unlink($old_img);
         $image = $request->file('brand_image');
         $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
         $image->move('upload/brand/',$name_gen);
         $save_url = 'upload/brand/'.$name_gen;

      Brand::findOrFail($barand_id)->update([
         'brand_name_eng' =>$request->brand_name_eng,
         'brand_name_dari' =>$request->brand_name_dari,
         'brand_slug_eng' =>$request->brand_name_eng,
         'brand_slug_dari' =>$request->brand_name_dari,
         'brand_image' =>$save_url,
      ]);
      $notification = array(
         'message' => 'Brand Updated Successfully',
         'alert-type' =>'success'
      );
      return redirect()->route('all.brand')->with($notification); 


         }else{

         Brand::findOrFail($barand_id)->update([
         'brand_name_eng' =>$request->brand_name_eng,
         'brand_name_dari' =>$request->brand_name_dari,
         'brand_slug_eng' =>$request->brand_name_eng,
         'brand_slug_dari' =>$request->brand_name_dari,
      
      ]);
      $notification = array(
         'message' => 'Brand Updated Successfully', 
         'alert-type' =>'success'
      );
      return redirect()->route('all.brand')->with($notification);  

         }  // end else
     }  //end method

     public function BrandDelete($id){
         $brand = Brand::findOrFail($id);
         $img = $brand->brand_image;

         Brand::findOrFail($id)->delete();
          $notification = array(
         'message' => 'Brand Deleted Successfully', 
         'alert-type' =>'success'
      );
      return redirect()->back()->with($notification);  

     }// end method


   }