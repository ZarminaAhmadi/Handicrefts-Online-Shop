<?php

namespace App\Http\Controllers\frontend;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
//use Auth;
use App\Models\User;
use App\Models\Category;
use App\Models\Slidshow;
use App\Models\SubCategory;
use App\Models\Product;
use App\Models\MultiImg;
use Illuminate\Support\Facades\Hash;

class IndexController extends Controller
{
    public function index()
    {

        $products = Product::where('status', 1)->orderBy('id', 'DESC')->limit(6)->get();
        $slidshow = Slidshow::where('status', 1)->orderBy('id', 'DESC')->limit(3)->get();


        $categories = Category::orderBy('category_name_eng', 'ASC')->get();
        // dd($categories);
        $subcategories = array();
        foreach ($categories as $category) {

            $subcategories[] = SubCategory::where('category_id', $category->id)->orderBy('subcategory_name_eng', 'ASC')->get();
        }
        // dd($subcategories);
        $featured = Product::where('featured', 1)->orderBy('id', 'DESC')->limit(6)->get();
        $hot_deals = Product::where('hot_deals', 1)->orderBy('id', 'DESC')->limit(3)->get();

        return view('frontend.index', compact('slidshow', 'categories', 'subcategories', 'products', 'featured', 'hot_deals'));
    }

    public function UserLogout()
    {
        Auth::logout();
        return Redirect()->route('login');
    }

    public function UserProfile()
    {
        $id = Auth::user()->id;
        $user = User::find($id);
        return view('frontend.profile.user_profile', compact('user'));
    }

    public function UserProfileStore(Request $request)
    {

        $data = User::find(Auth::user()->id);
        $data->name = $request->name;
        $data->email = $request->email;
        $data->phone = $request->phone;

        if ($request->file('profile_photo_path')) {
            $file = $request->file('profile_photo_path');
            @unlink(public_path('upload/user_images/' . $data->profile_photo_path));
            $filename = date('YmdHi') . $file->getClientOriginalName();
            $file->move(public_path('upload/user_images'), $filename);
            $data['profile_photo_path'] = $filename;
        }

        $data->save();

        $notification = array(
            'message' => 'User Profile Updated Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('dashboard')->with($notification);
    } //end method
    public function UserChangePassword()
    {
        $id = Auth::user()->id;
        $user = User::find($id);
        return view('frontend.profile.change_password', compact('user'));
    }


    public function UserPasswordUpdate(Request $request)
    {
        $validateData = $request->validate([
            'oldpassword' => 'required',
            'password' => 'required|confirmed',
        ]);

        $hashedPassword = Auth::user()->password;
        if (Hash::check($request->oldpassword, $hashedPassword)) {
            $user = User::find(Auth::id());
            $user->password = Hash::make($request->password);
            $user->save();
            Auth::logout();
            return redirect()->route('user.logout');
        } else {
            return redirect()->back();
        }
    } //end method

    public function ProductDetails($id)
    {
        $product = Product::findOrFail($id);
        $multiImag = MultiImg::where('product_id', $id)->get();
        return view('frontend.product.product_details', compact('product', 'multiImag'));
    }
}
