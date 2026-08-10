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
        Schema::create('jewellery_custom_orders', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('customer_id');
            $table->unsignedBigInteger('company_id')->nullable();
            $table->string('client_name', 150);
            $table->string('client_mobile', 30)->nullable();
            $table->string('client_email', 150)->nullable();
            $table->string('order_type', 50)->nullable();
            $table->string('category', 80)->nullable();
            $table->json('reference_images')->nullable();
            $table->string('budget_range', 100)->nullable();
            $table->string('metal_preference', 80)->nullable();
            $table->string('stone_preference', 80)->nullable();
            $table->string('timeline_required', 100)->nullable();
            $table->text('special_requirements')->nullable();
            $table->decimal('quoted_amount', 10, 2)->nullable();
            $table->decimal('advance_paid', 10, 2)->nullable();
            $table->string('order_status', 30)->default('inquiry');
            $table->json('design_files')->nullable();
            $table->json('progress_updates')->nullable();
            $table->date('appointment_date')->nullable();
            $table->string('appointment_time', 30)->nullable();
            $table->timestamps();

            $table->foreign('customer_id')->references('id')->on('customers')->onDelete('cascade');
            $table->index('company_id');
            $table->index('order_status');
            $table->index('order_type');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jewellery_custom_orders');
    }
};
