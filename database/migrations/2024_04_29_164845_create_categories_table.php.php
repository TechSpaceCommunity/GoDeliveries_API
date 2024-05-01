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
        if (!Schema::hasTable('riders')) {
            Schema::create('categories', function (Blueprint $table) {
                $table->id();
                $table->string('title');
                $table->string('slug')->unique();
                $table->text('summary')->nullable();
                $table->string('photo')->nullable();
                $table->unsignedBigInteger('parent_cat_id')->nullable();
                $table->unsignedBigInteger('restaurant_id')->nullable();
                $table->enum('status',['active','inactive'])->default('inactive');
                $table->foreign('parent_cat_id')->references('id')->on('major_categories')->onDelete('SET NULL');
                $table->foreign('restaurant_id')->references('id')->on('restaurants')->onDelete('SET NULL');
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('categories');
    }
};
