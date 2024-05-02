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
        Schema::create('dispatches', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('rider_id');
            $table->unsignedBigInteger('order_id');
            $table->unsignedBigInteger('restaurant_id');
            $table->string('rider_email');
            $table->string('address');
            $table->float('rider_amount');
            $table->float('order_amount');
            $table->enum('status', ['pending', 'delivered'])->default('pending');
            $table->timestamps();

            $table->foreign('rider_id')->references('id')->on('riders')->onDelete('CASCADE');
            $table->foreign('order_id')->references('id')->on('orders')->onDelete('CASCADE');
            $table->foreign('restaurant_id')->references('id')->on('restaurants')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dispatches');
    }
};
