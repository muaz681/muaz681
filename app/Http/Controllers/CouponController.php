<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Str;
use App\Models\Coupon;
use Carbon\Carbon;

class CouponController extends Controller
{
    function index(){
      return view('coupon.index');
    }
    function couponinsert(Request $request){
      $coupon_validity = $request->coupon_validity_date. " " .$request->coupon_validity_time;
      if (Str::endsWith($request->discount_amount, '%')) {
        if (Str::before($request->discount_amount, '%') < 100) {
          $main_value = Str::before($request->discount_amount, '%');
          if (is_numeric($main_value)) {
            Coupon::insert([
              'coupon_name' => $request->coupon_name,
              'discount_amount' => $request->discount_amount,
              'coupon_validity' => $coupon_validity,
              'created_at' => Carbon::now(),
            ]);
          }
          else {
            echo "not ok";
          }

        }
        else {
          echo "100 theke boro";
        }

      }
      else {
        if (is_numeric($request->discount_amount)) {
          Coupon::insert([
            'coupon_name' => $request->coupon_name,
            'discount_amount' => $request->discount_amount,
            'coupon_validity' => $coupon_validity,
            'created_at' => Carbon::now(),
          ]);
        }
        else {
          echo "not ok";
        }

      }
      return back();
    }
}
