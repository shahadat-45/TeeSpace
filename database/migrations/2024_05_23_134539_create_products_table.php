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
            $table->integer('category_id')->nullable();
            $table->integer('subcategory_id')->nullable();
            $table->integer('brand_id')->nullable();
            $table->string('product_name'); 
            $table->string('short_desp');
            $table->longText('long_desp');
            $table->longText('additional_info')->nullable();
            $table->string('tags')->nullable();
            $table->string('slug');
            $table->string('thumbnail');
            $table->integer('product_show')->default(1);
            $table->timestamps();
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
