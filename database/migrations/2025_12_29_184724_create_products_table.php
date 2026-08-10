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
        if (Schema::hasTable('products')) {
            $hasNewSchema = Schema::hasColumn('products', 'name') && Schema::hasColumn('products', 'slug');
            if (!$hasNewSchema) {
                if (!Schema::hasTable('products_legacy')) {
                    Schema::rename('products', 'products_legacy');
                } else {
                    Schema::drop('products');
                }
            } else {
                return;
            }
        }

        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable()->comment('NULL for admin products');
            $table->string('name');
            $table->string('slug')->unique();
            $table->text('description')->nullable();
            $table->unsignedBigInteger('category_id')->nullable();
            $table->enum('type', ['product', 'service'])->default('product');
            $table->decimal('price', 10, 2);
            $table->decimal('sale_price', 10, 2)->nullable();
            $table->integer('stock_quantity')->default(0);
            $table->string('sku')->nullable();
            $table->json('images')->nullable();
            $table->enum('status', ['active', 'inactive', 'pending', 'out_of_stock'])->default('active');
            $table->boolean('is_featured')->default(0);
            $table->enum('source', ['admin', 'user'])->default('user');
            $table->unsignedBigInteger('approved_by')->nullable()->comment('Admin ID who approved');
            $table->timestamp('approved_at')->nullable();
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('customers')->onDelete('cascade');
            $table->foreign('category_id')->references('id')->on('product_categories')->onDelete('set null');
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
