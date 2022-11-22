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
            $table->id();
            $table->string('product_name_eng');
            $table->string('product_code');
            $table->string('product_qty');
            $table->string('product_size_eng')->nullable();
            $table->string('product_color_eng');
            $table->string('selling_price');
            $table->string('descp_eng');
            $table->string('product_thambnail');
            $table->integer('hot_deals')->nullable();
            $table->integer('featured')->nullable();
            $table->integer('special_offer')->nullable();
            $table->integer('special_deals')->nullable();
            $table->integer('status')->default(0);
            $table->unsignedBigInteger('category_id');
            $table->unsignedBigInteger('subcategory_id');
            $table->unsignedBigInteger('brand_id');
            $table->foreign("category_id")->references("id")->on("categories")->onDelete("cascade");
            $table->foreign("subcategory_id")->references("id")->on("sub_categories")->onDelete("cascade");
            $table->foreign("brand_id")->references("id")->on("brands")->onDelete("cascade");

            $table->timestamps();
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
