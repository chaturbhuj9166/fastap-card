<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('creator_portfolio', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('customer_id')->index();
            $table->unsignedBigInteger('company_id')->nullable()->index();
            $table->string('content_type', 40)->nullable();
            $table->string('title', 150);
            $table->string('brand_name', 150)->nullable();
            $table->string('content_url', 255)->nullable();
            $table->string('thumbnail', 255)->nullable();
            $table->unsignedBigInteger('views_count')->nullable();
            $table->decimal('engagement_rate', 6, 2)->nullable();
            $table->text('description')->nullable();
            $table->boolean('is_featured')->default(false);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('creator_portfolio');
    }
};
