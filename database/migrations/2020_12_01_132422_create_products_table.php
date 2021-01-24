<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('product_name', 100);
            $table->longText('product_short_text');
            $table->longText('product_long_text');
            $table->integer('category_id');
            $table->integer('product_price');
            $table->integer('product_quantity');
            $table->integer('alert_quantity');
            $table->string('product_photo')->default('defaultproductphoto.jpg');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
