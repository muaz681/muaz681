@extends('layouts.frontend_master')
@section('frontend_common_section')
  <!-- Start Bradcaump area -->
        <div class="ht__bradcaump__area bg-image--3">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="bradcaump__inner text-center">
                        	<h2 class="bradcaump-title">Shopping Cart</h2>
                            <nav class="bradcaump-content">
                              <a class="breadcrumb_item" href="index.html">Home</a>
                              <span class="brd-separetor">/</span>
                              <span class="breadcrumb_item active">Shopping Cart</span>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Bradcaump area -->
        <!-- cart-main-area start -->
        <div class="cart-main-area section-padding--lg bg--white">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 col-sm-12 ol-lg-12">
                            <div class="table-content wnro__table table-responsive">
                                <table>
                                    <thead>
                                        <tr class="title-top">
                                            <th class="product-thumbnail">Image</th>
                                            <th class="product-name">Product</th>
                                            <th class="product-price">Price</th>
                                            <th class="product-quantity">Quantity</th>
                                            <th class="product-subtotal">Total</th>
                                            <th class="product-remove">Remove</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                      <form action="{!! route('cartupdate') !!}" method="post">
                                        @csrf
                                      @forelse (getcartproducts() as $getcartproduct)
                                        <tr>
                                            <td class="product-thumbnail"><a href="#"><img src="{!! asset('uploads/product_images') !!}/{{ $getcartproduct->relationtoproducttable->product_photo }}" alt="product img"></a></td>
                                            <td class="product-name"><a href="#">{{ $getcartproduct->relationtoproducttable->product_name }}</a></td>
                                            <td class="product-price"><span class="amount">${{ $getcartproduct->relationtoproducttable->product_price }}</span></td>
                                            <td class="product-quantity">
                                              <input type="hidden" name="cart_id[]" value="{{ $getcartproduct->id }}">
                                              <input name="cart_amount[]" type="number" value="{{ $getcartproduct->quantity }}">
                                            </td>
                                            <td class="product-subtotal">${{ $getcartproduct->relationtoproducttable->product_price * $getcartproduct->quantity }}</td>
                                            <td class="product-remove"><a href="{!! route('cartdelete', $getcartproduct->id) !!}">X</a></td>
                                        </tr>
                                      @empty
                                        <tr>
                                          <td colspan="50">Not include Add to Cart</td>
                                        </tr>
                                      @endforelse
                                    </tbody>
                                </table>
                            </div>
                        <div class="cartbox__btn">
                            <ul class="cart__btn__list d-flex flex-wrap flex-md-nowrap flex-lg-nowrap justify-content-between">
                                <li><a href="#">Coupon Code</a></li>
                                <li><a href="#">Apply Code</a></li>
                                <li><button type="submit">Update Cart</button></li>
                                </form>
                                <li><a href="#">Check Out</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-6 offset-lg-6">
                        <div class="cartbox__total__area">
                            <div class="cartbox-total d-flex justify-content-between">
                                <ul class="cart__total__list">
                                    <li>Cart total</li>
                                    <li>Sub Total</li>
                                </ul>
                                <ul class="cart__total__tk">
                                    <li>${{ getcarttotalamount() }}</li>
                                    <li>${{ getcarttotalamount() }}</li>
                                </ul>
                            </div>
                            <div class="cart__total__amount">
                                <span>Grand Total</span>
                                <span>${{ getcarttotalamount() }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- cart-main-area end -->
@endsection
