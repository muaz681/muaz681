<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable = ['product_name', 'product_price', 'product_quantity', 'alert_quantity','product_photo', 'category_id'];
    function relationtocetagorytable(){
      return $this->hasOne('App\Models\Category', 'id', 'category_id');
    }
    function relationtoproductgallerytable(){
      return $this->hasMany('App\Models\Product_Gallery', 'product_id', 'id');
    }
}
