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
         'brand_name_eng.required' =>'Inpute Brand Dari Name',

      ]);
      $image = $request->file('brand_image');
      $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
      Image::make($image)->resize(300,300)->save('upload/brand/'.$name_gen);
      $save_url = 'upload/brand/'.$name_gen;

      Brand::insert([
         'brand_name_eng' =>$request->brand_name_eng,
         'brand_name_dari' =>$request->brand_name_dari,
         'brand_slug_eng' =>$request->strtolower(str_replace (' ','_',$request->brand_name_eng)),
         'brand_slug_dari' =>str_replace (' ','_',$request->brand_name_dari),
         'brand_image' =>$save_url,
      ]);
      $notification = array(
         'message' => 'Brand Inserted Successfully',
         'alert-type' =>'success'
      );
      return redirect()->back()->with($notification); 

     } //end method
   }