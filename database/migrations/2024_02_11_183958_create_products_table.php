<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('category_id');
            $table->unsignedBigInteger('subCategory_id');
            $table->integer('childCategory_id')->nullable();
            $table->integer('brand_id')->nullable();
            $table->string('product_name');
            $table->string('slug')->nullable();
            $table->string('product_code');
            $table->string('product_unit')->nullable();
            $table->string('product_tags')->nullable();
            $table->string('purchase_price')->nullable();
            $table->string('selling_price')->nullable();
            $table->string('discount_price')->nullable();
            $table->string('quantity_stock')->nullable();
            $table->integer('warehouse')->nullable();
            $table->string('description')->nullable();
            $table->string('video')->nullable();
            $table->string('thumbnail')->nullable();
            $table->string('images')->nullable();
            $table->integer('featured')->nullable();
            $table->string('color')->nullable();
            $table->string('size')->nullable();
            $table->integer('today_deal')->nullable();
            $table->integer('status')->nullable();
            $table->integer('flash_deal_id')->nullable();
            $table->integer('cash_on_delivery')->nullable();
            $table->integer('product_slide')->nullable();
            $table->integer('admin_id')->nullable();
            $table->integer('pickup_point_id')->nullable();
            $table->string('date')->nullable();
            $table->string('month')->nullable();
            $table->timestamps();
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
            $table->foreign('subCategory_id')->references('id')->on('sub_categories')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
