<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('brand_collaborations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('customer_id')->index();
            $table->unsignedBigInteger('company_id')->nullable()->index();
            $table->string('brand_name', 150);
            $table->string('brand_email', 150)->nullable();
            $table->string('brand_mobile', 30)->nullable();
            $table->string('collaboration_type', 60)->nullable();
            $table->string('platform', 60)->nullable();
            $table->json('deliverables')->nullable();
            $table->decimal('budget', 12, 2)->nullable();
            $table->text('campaign_brief')->nullable();
            $table->date('campaign_start_date')->nullable();
            $table->date('campaign_end_date')->nullable();
            $table->string('status', 30)->nullable();
            $table->boolean('contract_signed')->default(false);
            $table->string('payment_status', 30)->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('brand_collaborations');
    }
};
