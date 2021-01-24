<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use Carbon\Carbon;
use App\Models\Product;

class CartController extends Controller
{
  // add to cart start
    function index(Request $request){
        $mac = exec('getmac');
        // Storing 'getmac' value in $MAC
        $mac = strtok($mac, ' ');
        $avaliable_product_quantity = Product::find($request->product_id)->product_quantity;
        $cart_info = Cart::where('mac', $mac)->where('product_id', $request->product_id)->first();
        if ($cart_info) {
          $old_cart_quantity = $cart_info->quantity;
        }
        else {
          $old_cart_quantity = 0;
        }
        if ($avaliable_product_quantity >= ($request->quantity + $old_cart_quantity)) {
          if ($cart_info) {
              Cart::where('mac', $mac)->where('product_id', $request->product_id)->increment('quantity', $request->quantity);
          }
          else {
            Cart::insert([
              'mac' => $mac,
              'product_id' => $request->product_id,
              'quantity' => $request->quantity,
              'created_at' => Carbon::now(),
            ]);
          }
        }
        else {
          echo "";
          return back()->with('errorstatus', 'Products Not Available');
          // return redirect('single_product#cart_error_sectuion')->with('errorstatus', 'Products Not Available');
        }
        return back();
    }
    // add to cart end

    // cart edit start
    function cartedit(){
      return view('cart');
    }
    // cart edit end

    // cart delete start
    function cartdelete($cart_id){
      Cart::find($cart_id)->delete();
      return back();
    }
    // cart delete end

    // cart udate start
    function cartupdate(Request $request){
      foreach ($request->cart_id as $key => $value) {
        $cart_id = $value;
        $product_id = Cart::find($value)->product_id;
        $update_amount = $request->cart_amount[$key];
        $available_amount = Product::find(Cart::find($value)->product_id)->product_quantity;
        if ($available_amount >= $update_amount) {
          Cart::find($value)->update([
            'quantity' => $update_amount,
          ]);
        }
        // else {
        //   echo "no enter";
        // }

      }
      return back();
    }
    // cart udate end

}
