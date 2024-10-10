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
        Schema::create('billings', function (Blueprint $table) {
            $table->id();
            $table->integer('customer_id');
            $table->string('order_id');
            $table->string('fname');
            $table->string('lname')->nullable();
            $table->integer('phone');
            $table->string('email');
            $table->string('country');
            $table->string('city');
            $table->string('zip')->nullable();
            $table->string('company')->nullable();
            $table->string('address');
            $table->string('massage')->nullable();
            $table->integer('save_it')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('billings');
    }
};
