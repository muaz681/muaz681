<?php
function getcartamount(){
    $mac = exec('getmac');
    // Storing 'getmac' value in $MAC
    $mac = strtok($mac, ' ');
    return $cart_amount = App\Models\Cart::where('mac', $mac)->count();
}
function getcartproducts(){
    $mac = exec('getmac');
    // Storing 'getmac' value in $MAC
    $mac = strtok($mac, ' ');
    return $cart_amount = App\Models\Cart::where('mac', $mac)->orderBy('id', 'desc')->get();
}
function getcarttotalamount(){
    $mac = exec('getmac');
    // Storing 'getmac' value in $MAC
    $mac = strtok($mac, ' ');
    $cart_products = App\Models\Cart::where('mac', $mac)->orderBy('id', 'desc')->get();
    $final_amount = 0;
    foreach ($cart_products as $cart_product) {
      $final_amount += $cart_product->relationtoproducttable->product_price * $cart_product->quantity;
    }
    return $final_amount;
}
