<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Contact;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;
use App\Models\Banner;
use App\Models\Category;

class FrontendController extends Controller
{
  // index section
    function index(){
      $products = Product::all();
      $banner_images = Banner::all();
      $categories = Category::all();
      return view('welcome', compact('products', 'banner_images', 'categories'));
    }
    // contact section
    function contact(){
      return view('contact');
    }
    // contact submit
    function contactsubmit(Request $request){
      if ($request->hasFile('upload_file')) {
        $last_id = Contact::insertGetId($request->except('_token')+[
          'created_at' => Carbon::now(),
        ]);
        $upload_file = $request->file('upload_file');
        $path = $request->file('upload_file')->storeAs(
              'contact_file', $last_id.'.'.$upload_file->getClientOriginalExtension()
          );
          Contact::find($last_id)->update([
            'upload_file' => $last_id.'.'.$upload_file->getClientOriginalExtension()
          ]);
      }
      else {
        Contact::insertGetId($request->except('_token')+[
          'upload_file' => 'No File',
          'created_at' => Carbon::now(),
        ]);
      }
      return redirect('contact#contact_msg')->with('status', 'Your Message is recieved!');
    }
    function productdetails($product_id, $product_slug){
        $product_info = Product::find($product_id);
        $related_products = Product::where('category_id', $product_info->category_id)->where('id', '!=', $product_id)->get();
        return view('single_product', compact('product_info', 'related_products'));
    }

}
