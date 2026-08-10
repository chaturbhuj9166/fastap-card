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
        Schema::create('talent_social_stats', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('customer_id');
            $table->enum('platform', ['instagram', 'youtube', 'facebook', 'tiktok', 'twitter', 'linkedin', 'other']);
            $table->string('platform_url')->nullable();
            $table->string('platform_username')->nullable();
            $table->bigInteger('followers')->default(0);
            $table->decimal('engagement_rate', 5, 2)->nullable(); // Percentage
            $table->bigInteger('total_views')->default(0);
            $table->integer('total_posts')->default(0);
            $table->boolean('is_verified')->default(false);
            $table->timestamp('last_updated')->nullable();
            $table->timestamps();

            $table->foreign('customer_id')->references('id')->on('customers')->onDelete('cascade');
            $table->index(['customer_id', 'platform']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('talent_social_stats');
    }
};
