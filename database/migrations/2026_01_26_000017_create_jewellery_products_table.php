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
        Schema::create('jewellery_products', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('customer_id');
            $table->unsignedBigInteger('company_id')->nullable();
            $table->string('category', 50);
            $table->string('product_name', 150);
            $table->string('product_code', 80)->nullable();
            $table->text('description')->nullable();
            $table->string('metal_type', 50)->nullable();
            $table->string('metal_purity', 20)->nullable();
            $table->decimal('weight_grams', 10, 2)->nullable();
            $table->json('stone_details')->nullable();
            $table->decimal('making_charges', 10, 2)->nullable();
            $table->decimal('price', 10, 2)->nullable();
            $table->json('images')->nullable();
            $table->string('video_url', 255)->nullable();
            $table->boolean('is_bestseller')->default(false);
            $table->boolean('is_trending')->default(false);
            $table->boolean('is_available')->default(true);
            $table->unsignedInteger('stock_quantity')->nullable();
            $table->json('certifications')->nullable();
            $table->timestamps();

            $table->foreign('customer_id')->references('id')->on('customers')->onDelete('cascade');
            $table->index('company_id');
            $table->index('category');
            $table->index('metal_type');
            $table->index('is_available');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jewellery_products');
    }
};
