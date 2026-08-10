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
        Schema::create('talent_portfolio', function (Blueprint $table) {
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
            $table->string('title');
            $table->text('description')->nullable();
            $table->enum('media_type', ['image', 'video', 'audio']);
            $table->string('media_url'); // URL or path
            $table->string('thumbnail')->nullable(); // For videos
            $table->string('category')->nullable(); // Movies, Fashion, Events, etc.
            $table->year('year')->nullable();
            $table->integer('sort_order')->default(0);
            $table->boolean('is_featured')->default(false);
            $table->boolean('status')->default(true);
            $table->timestamps();

            $table->foreign('customer_id')->references('id')->on('customers')->onDelete('cascade');
            $table->index(['customer_id', 'talent_type', 'status']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('talent_portfolio');
    }
};
