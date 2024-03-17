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
        Schema::create('tickets', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->string('subject')->nullable();
            $table->string('service')->nullable();
            $table->string('priority')->nullable();
            $table->text('message')->nullable();
            $table->text('image')->nullable();
            $table->string('status')->nullable()->default(0)->comment("0 = inactive, 1=active");
            $table->string('date')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tickets');
    }
};
