<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMedicalReviewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('medical_reviews', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('customer_id'); // Doctor/Hospital
            $table->unsignedBigInteger('medical_profile_id')->nullable();
            $table->enum('profile_type', ['doctor', 'hospital', 'daycare'])->default('doctor');

            // Reviewer details
            $table->string('reviewer_name');
            $table->string('reviewer_email')->nullable();
            $table->string('reviewer_mobile')->nullable();

            // Review details
            $table->integer('rating')->default(5); // 1-5 stars
            $table->text('review_text');
            $table->date('visit_date')->nullable();
            $table->string('treatment_type')->nullable();

            // Moderation
            $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending');
            $table->timestamp('approved_at')->nullable();
            $table->boolean('is_featured')->default(false);

            // Google review integration
            $table->string('google_review_url')->nullable();
            $table->boolean('is_google_review')->default(false);

            $table->foreign('customer_id')->references('id')->on('customers')->onDelete('cascade');
            $table->foreign('medical_profile_id')->references('id')->on('medical_profiles')->onDelete('set null');
            $table->timestamps();

            $table->index(['customer_id', 'status']);
            $table->index(['rating']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('medical_reviews');
    }
}
