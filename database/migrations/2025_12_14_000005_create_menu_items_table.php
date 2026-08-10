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
        Schema::create('menu_items', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('customer_id');
            $table->unsignedBigInteger('company_id')->nullable();
            $table->unsignedBigInteger('category_id');
            $table->string('name', 255);
            $table->text('description')->nullable();
            $table->string('image', 255)->nullable();
            $table->decimal('price', 10, 2)->nullable();
            $table->decimal('discounted_price', 10, 2)->nullable();
            $table->string('currency', 10)->default('INR');
            $table->enum('dietary_type', ['veg', 'non-veg', 'vegan', 'eggetarian'])->default('veg');
            $table->tinyInteger('spice_level')->default(0)->comment('0=none, 1-5 spice levels');
            $table->tinyInteger('is_bestseller')->default(0);
            $table->tinyInteger('is_chefs_special')->default(0);
            $table->tinyInteger('is_new')->default(0);
            $table->tinyInteger('is_available')->default(1);
            $table->string('allergens', 255)->nullable()->comment('Comma-separated allergens');
            $table->json('nutrition_info')->nullable();
            $table->json('variants')->nullable()->comment('Size/portion variants with prices');
            $table->string('preparation_time', 50)->nullable();
            $table->integer('sort_order')->default(0);
            $table->tinyInteger('status')->default(1);
            $table->timestamps();

            $table->foreign('category_id')->references('id')->on('menu_categories')->onDelete('cascade');
            $table->index('customer_id');
            $table->index('company_id');
            $table->index('category_id');
            $table->index('dietary_type');
            $table->index('status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('menu_items');
    }
};
