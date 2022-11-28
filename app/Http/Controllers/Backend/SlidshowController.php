<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\slidshow;
use Carbon\Carbon;
use Image;

class SlidshowController extends Controller
{
    public function SlidshowView()
    {
        $slidshows = Slidshow::latest()->get();
        return view('backend.slidshow.slidshow_view', compact('slidshows'));
    }

    public function SlidshowStore(Request $request)
    {


        $request->validate([

            'slidshow_img' => 'required',
        ], [
            'slidshow_img.required' => 'Plz Select One Image',

        ]);

        $image = $request->file('slidshow_img');
        $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
        $image->move('upload/slidshow/', $name_gen);
        $save_url = 'upload/slidshow/' . $name_gen;

        slidshow::insert([
            'title' => $request->title,
            'description' => $request->description,
            'slidshow_img' => $save_url,

        ]);

        $notification = array(
            'message' => 'Slidshow Inserted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    } // end method



    public function SlidshowEdit($id)
    {
        $slidshows = slidshow::findOrFail($id);
        return view('backend.slidshow.slidshow_edit', compact('slidshows'));
    }


    public function SlidshowUpdate(Request $request)
    {

        $slidshow_id = $request->id;
        $old_img = $request->old_image;

        if ($request->file('slidshow_img')) {

            // unlink($old_img);
            $image = $request->file('slidshow_img');
            $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
            $image->move('upload/slidshow/', $name_gen);
            $save_url = 'upload/slidshow/' . $name_gen;

            slidshow::findOrFail($slidshow_id)->update([
                'title' => $request->title,
                'description' => $request->description,
                'slidshow_img' => $save_url,

            ]);

            $notification = array(
                'message' => 'Slidshow Updated Successfully',
                'alert-type' => 'success'
            );

            return redirect()->route('manage-slidshow')->with($notification);
        } else {

            slidshow::findOrFail($slidshow_id)->update([
                'title' => $request->title,
                'description' => $request->description,


            ]);

            $notification = array(
                'message' => 'Slidshow Updated Without Image Successfully',
                'alert-type' => 'success'
            );

            return redirect()->route('manage-slidshow')->with($notification);
        } // end else
    } // end method



    public function SlidshowDelete($id)
    {
        $slidshow = slidshow::findOrFail($id);
        $img = $slidshow->slidshow_img;
        // unlink($img);
        slidshow::findOrFail($id)->delete();

        $notification = array(
            'message' => 'Slidshow Deleted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    } // end method


    public function SlidshowInactive($id)
    {
        slidshow::findOrFail($id)->update(['status' => 0]);

        $notification = array(
            'message' => 'SlidshowInactive Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    } // end method


    public function SlidshowActive($id)
    {
        slidshow::findOrFail($id)->update(['status' => 1]);

        $notification = array(
            'message' => 'Slidshow Active Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    } // end method




}
