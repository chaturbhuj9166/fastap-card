<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('astro_client_data', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('customer_id')->index();
            $table->unsignedBigInteger('company_id')->nullable()->index();
            $table->string('client_mobile', 30)->nullable();
            $table->string('client_name', 150)->nullable();
            $table->date('birth_date')->nullable();
            $table->string('birth_time', 20)->nullable();
            $table->string('birth_place', 150)->nullable();
            $table->json('kundli_data')->nullable();
            $table->json('reports')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('astro_client_data');
    }
};
