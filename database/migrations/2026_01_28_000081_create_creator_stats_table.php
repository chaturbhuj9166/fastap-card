<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('creator_stats', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('customer_id')->index();
            $table->unsignedBigInteger('company_id')->nullable()->index();
            $table->string('platform', 40)->nullable();
            $table->string('handle', 120)->nullable();
            $table->unsignedBigInteger('followers_count')->nullable();
            $table->unsignedBigInteger('avg_reach')->nullable();
            $table->decimal('avg_engagement_rate', 6, 2)->nullable();
            $table->json('audience_demographics')->nullable();
            $table->unsignedBigInteger('monthly_views')->nullable();
            $table->date('last_updated')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('creator_stats');
    }
};
