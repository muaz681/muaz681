<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Banner;
use Image;

class BannerController extends Controller
{
    function index(){
      $banners = Banner::all();
      return view('banner.index', compact('banners'));
    }
    // banner image insert
    function bannerinsert(Request $request){
      $banner_info = Banner::create($request->except('_token'));
      if ($request->hasFile('banner_photo')) {
        $banner_photo = $request->file('banner_photo');
        $new_name = $banner_info->id.".".$banner_photo->getClientOriginalExtension();
        $save_location = "public/uploads/banner_images/".$new_name;
        Image::make($banner_photo)->resize(1920, 950)->save(base_path($save_location));
        $banner_info->banner_photo = $new_name;
        $banner_info->save();
      }
      return back()->with('status', 'Image Inserted Successfully');
    }
}
