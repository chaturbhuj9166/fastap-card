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
        Schema::create('production_portfolios', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('customer_id');
            $table->unsignedBigInteger('company_id')->nullable();
            $table->string('category', 50)->nullable();
            $table->string('project_title', 150);
            $table->string('client_name', 150)->nullable();
            $table->string('project_type', 100)->nullable();
            $table->string('thumbnail_image', 255)->nullable();
            $table->string('video_url', 255)->nullable();
            $table->json('images')->nullable();
            $table->text('description')->nullable();
            $table->date('production_date')->nullable();
            $table->boolean('is_featured')->default(false);
            $table->unsignedInteger('view_count')->default(0);
            $table->timestamps();

            $table->foreign('customer_id')->references('id')->on('customers')->onDelete('cascade');
            $table->index('company_id');
            $table->index('category');
            $table->index('is_featured');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('production_portfolios');
    }
};
