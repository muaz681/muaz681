<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\Product_Gallery;
use App\Http\Requests\ProductValidation;
use Carbon\Carbon;
use Image;

class ProductController extends Controller
{
  // Product select section
    function product(){
      $product_soft_deletes = Product::onlyTrashed()->get();
      $categoryes = Category::all();
      $users = Product::all();
      return view('product.index', compact('users', 'product_soft_deletes', 'categoryes'));
    }

    // Product insart section
// Request
// ProductValidation
    function productinsert(ProductValidation $request){
      $product_id = Product::insertGetId([
        'product_name' => $request->product_name,
        'product_short_text' => $request->product_short_text,
        'product_long_text' => $request->product_long_text,
        'category_id' => $request->category_id,
        'product_price' => $request->product_price,
        'product_quantity' => $request->product_quantity,
        'alert_quantity' => $request->alert_quantity,
        'created_at' => Carbon::now(),
      ]);
      if ($request->hasFile('product_photo')) {
        $product_photo = $request->file('product_photo');
        $new_name = $product_id.".".$product_photo->getClientOriginalExtension();
        $save_location = "public/uploads/product_images/".$new_name;
        Image::make($product_photo)->resize(270, 340)->save(base_path($save_location));
        Product::findOrFail($product_id)->update([
          'product_photo' => $new_name,
        ]);
      }
      if ($request->hasFile('product_multiple_photo')) {
        $initial = 1;
        foreach ($request->product_multiple_photo as $single_product_gallery) {
          $new_name = $initial.".".$single_product_gallery->getClientOriginalExtension();
          $initial++;
          $save_location = "public/uploads/product_gallery/".$product_id."-".$new_name;
          Image::make($single_product_gallery)->resize(450, 565)->save(base_path($save_location));
          Product_Gallery::insert([
            'product_id' => $product_id,
            'product_multiple_photo' => $product_id."-".$new_name,
            'created_at' => Carbon::now(),
          ]);
        }
      }
      return back()->with('status', 'Product Inserted Successfully');
    }

    // Product delete DOMCdataSection

    function productdelete($product_id){
      $product_delete_name = Product::findOrFail($product_id)->product_name;
      Product::findOrFail($product_id)->delete();
      return back()->withDelete_status($product_delete_name. ' Deleted Successfully');
    }

    // Product Restore section

    function productrestore($product_id){
      Product::withTrashed()->where('id', $product_id)->restore();
      return back();
    }

    // product trashed delete section
    function producttrashed($product_id){
      Product::withTrashed()->where('id', $product_id)->forceDelete();
      return back();
    }

    // product edit section
    function productedit($product_id){
      $product_edit = Product::findOrFail($product_id);
      $categoryes = Category::all();
      return view('product.edit', compact('product_edit', 'categoryes'));
    }
    // Product full edit funtion
    function productedited(ProductValidation $request){
      if ($request->hasFile('new_photo')){
        if (Product::findOrFail($request->product_id)->product_photo != 'defaultproductphoto.jpg') {
          unlink(base_path('public/uploads/product_images/'.Product::findOrFail($request->product_id)->product_photo));
        }
        // product edit image update start
        $product_photo = $request->file('new_photo');
        $new_name = $request->product_id.".".$product_photo->getClientOriginalExtension();
        $save_location = "public/uploads/product_images/".$new_name;
        Image::make($product_photo)->resize(270, 340)->save(base_path($save_location));
        Product::findOrFail($request->product_id)->update([
          'product_photo' => $new_name,
        ]);
        // product edit image update end
      }
      $product_edit_name = Product::findOrFail($request->product_id)->product_name;
      Product::findOrFail($request->product_id)->update([
      'product_name' => $request->product_name,
      'category_id' => $request->category_id,
      'product_price' => $request->product_price,
      'product_quantity' => $request->product_quantity,
      'alert_quantity' => $request->alert_quantity,
    ]);

      return redirect('product')->withEdit_status($product_edit_name . ' Edit Successfully!');

    }
}
