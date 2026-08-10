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
        Schema::create('transformation_gallery', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('customer_id');
            $table->unsignedBigInteger('company_id')->nullable();
            $table->string('member_name', 150)->nullable();
            $table->string('before_photo', 255)->nullable();
            $table->string('after_photo', 255)->nullable();
            $table->unsignedInteger('duration_months')->nullable();
            $table->string('program_type', 50)->nullable();
            $table->decimal('weight_lost_kg', 6, 2)->nullable();
            $table->text('testimonial')->nullable();
            $table->boolean('is_featured')->default(false);
            $table->timestamps();

            $table->foreign('customer_id')->references('id')->on('customers')->onDelete('cascade');
            $table->index('company_id');
            $table->index('is_featured');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transformation_gallery');
    }
};
