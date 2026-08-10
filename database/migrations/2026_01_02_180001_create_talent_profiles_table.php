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
        Schema::create('talent_profiles', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('customer_id');
            $table->enum('talent_type', [
                'actor',
                'model',
                'singer',
                'dancer',
                'youtuber',
                'music_producer',
                'anchor',
                'influencer',
                'custom'
            ]);
            $table->string('custom_talent_name')->nullable(); // For custom talent type
            $table->boolean('is_active')->default(true);
            $table->boolean('is_default')->default(false);
            $table->integer('display_order')->default(0);
            $table->timestamps();

            $table->foreign('customer_id')->references('id')->on('customers')->onDelete('cascade');
            $table->index(['customer_id', 'is_active']);
            $table->unique(['customer_id', 'talent_type']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('talent_profiles');
    }
};
