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
        Schema::create('table_orders', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('customer_id');
            $table->unsignedBigInteger('company_id')->nullable();
            $table->unsignedBigInteger('table_id');
            $table->string('order_number', 50)->nullable();
            $table->json('items')->nullable();
            $table->decimal('total_amount', 10, 2)->nullable();
            $table->string('order_status', 20)->default('pending');
            $table->timestamp('order_time')->nullable();
            $table->timestamp('served_time')->nullable();
            $table->string('payment_status', 20)->default('pending');
            $table->string('payment_mode', 30)->nullable();
            $table->text('notes')->nullable();
            $table->timestamps();

            $table->foreign('customer_id')->references('id')->on('customers')->onDelete('cascade');
            $table->foreign('table_id')->references('id')->on('restaurant_tables')->onDelete('cascade');
            $table->index('company_id');
            $table->index(['table_id', 'order_status']);
            $table->index('order_number');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('table_orders');
    }
};
