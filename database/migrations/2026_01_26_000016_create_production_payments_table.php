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
        Schema::create('production_payments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('customer_id');
            $table->unsignedBigInteger('company_id')->nullable();
            $table->unsignedBigInteger('project_id')->nullable();
            $table->string('payment_stage', 30)->nullable();
            $table->decimal('amount', 10, 2)->nullable();
            $table->string('payment_mode', 30)->nullable();
            $table->string('payment_status', 30)->default('pending');
            $table->string('transaction_id', 100)->nullable();
            $table->date('paid_on')->nullable();
            $table->text('notes')->nullable();
            $table->timestamps();

            $table->foreign('customer_id')->references('id')->on('customers')->onDelete('cascade');
            $table->foreign('project_id')->references('id')->on('production_projects')->onDelete('set null');
            $table->index('company_id');
            $table->index('payment_status');
            $table->index('payment_stage');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('production_payments');
    }
};
