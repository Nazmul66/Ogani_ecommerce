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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->string('c_name')->nullable();
            $table->string('c_city')->nullable();
            $table->string('c_division')->nullable();
            $table->string('c_district')->nullable();
            $table->text('c_address')->nullable();
            $table->text('c_address_optional')->nullable();
            $table->string('c_zipCode')->nullable();
            $table->string('c_phone')->nullable();
            $table->string('c_phone_optional')->nullable();
            $table->string('c_email')->nullable();
            $table->string('subtotal');
            $table->string('total');
            $table->string('coupon_code')->nullable();
            $table->string('coupon_discount')->nullable();
            $table->string('after_discount')->nullable();
            $table->string('payment_type')->nullable();
            $table->string('tax')->nullable();
            $table->string('shipping_charge')->nullable();
            $table->string('transaction_id')->nullable();
            $table->integer('status')->nullable()->default(0);
            $table->string('date')->nullable();
            $table->string('month')->nullable();
            $table->string('year')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
