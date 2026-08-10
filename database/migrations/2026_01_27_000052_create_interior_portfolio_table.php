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
        Schema::create('interior_portfolio', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('customer_id');
            $table->unsignedBigInteger('company_id')->nullable();
            $table->string('project_title', 150);
            $table->string('project_category', 50)->nullable();
            $table->string('room_type', 50)->nullable();
            $table->string('style', 50)->nullable();
            $table->unsignedInteger('area_sqft')->nullable();
            $table->json('before_images')->nullable();
            $table->json('after_images')->nullable();
            $table->json('design_render_images')->nullable();
            $table->string('video_url', 255)->nullable();
            $table->text('project_description')->nullable();
            $table->boolean('is_featured')->default(false);
            $table->timestamps();

            $table->foreign('customer_id')->references('id')->on('customers')->onDelete('cascade');
            $table->index('company_id');
            $table->index('project_category');
            $table->index('is_featured');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('interior_portfolio');
    }
};
