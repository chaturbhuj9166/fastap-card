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
        Schema::create('metal_rates', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('customer_id')->nullable();
            $table->unsignedBigInteger('company_id')->nullable();
            $table->string('metal_type', 30);
            $table->string('purity', 20)->nullable();
            $table->decimal('rate_per_gram', 10, 2);
            $table->date('rate_date')->nullable();
            $table->string('city', 100)->nullable();
            $table->timestamps();

            $table->index('company_id');
            $table->index('customer_id');
            $table->index('metal_type');
            $table->index('rate_date');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('metal_rates');
    }
};
