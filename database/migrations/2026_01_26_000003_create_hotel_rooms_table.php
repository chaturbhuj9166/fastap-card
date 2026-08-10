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
        Schema::create('hotel_rooms', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('customer_id');
            $table->unsignedBigInteger('company_id')->nullable();
            $table->unsignedBigInteger('profile_id')->nullable();
            $table->string('room_number', 50);
            $table->string('room_type', 50)->nullable();
            $table->string('floor', 50)->nullable();
            $table->string('qr_code_path', 255)->nullable();
            $table->string('status', 20)->default('vacant');
            $table->integer('max_occupancy')->nullable();
            $table->timestamps();

            $table->foreign('customer_id')->references('id')->on('customers')->onDelete('cascade');
            $table->foreign('profile_id')->references('id')->on('restaurant_profiles')->onDelete('set null');
            $table->unique(['customer_id', 'room_number']);
            $table->index('company_id');
            $table->index('status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hotel_rooms');
    }
};
