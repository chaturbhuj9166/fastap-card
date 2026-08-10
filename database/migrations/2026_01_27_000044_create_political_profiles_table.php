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
        Schema::create('political_profiles', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('customer_id');
            $table->unsignedBigInteger('company_id')->nullable();
            $table->string('party_name', 150)->nullable();
            $table->string('constituency', 150)->nullable();
            $table->string('role_title', 150)->nullable();
            $table->text('biography')->nullable();
            $table->text('manifesto')->nullable();
            $table->text('office_address')->nullable();
            $table->string('office_hours', 100)->nullable();
            $table->json('focus_areas')->nullable();
            $table->json('achievements')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();

            $table->foreign('customer_id')->references('id')->on('customers')->onDelete('cascade');
            $table->index('company_id');
            $table->index('party_name');
            $table->index('constituency');
            $table->index('is_active');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('political_profiles');
    }
};
