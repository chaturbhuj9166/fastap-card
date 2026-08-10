<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('profile_location_tracks', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('customer_id');
            $table->string('profile_slug', 255);
            $table->unsignedBigInteger('theme_id')->nullable();
            $table->string('tap_source', 20)->default('unknown');
            $table->string('location_status', 20)->default('unknown');
            $table->decimal('latitude', 10, 7)->nullable();
            $table->decimal('longitude', 10, 7)->nullable();
            $table->unsignedInteger('accuracy_m')->nullable();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->string('referrer', 255)->nullable();
            $table->timestamps();

            $table->index(['customer_id', 'created_at']);
            $table->index(['profile_slug']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('profile_location_tracks');
    }
};
