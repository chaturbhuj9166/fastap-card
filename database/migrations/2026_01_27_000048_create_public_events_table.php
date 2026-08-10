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
        Schema::create('public_events', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('customer_id');
            $table->unsignedBigInteger('company_id')->nullable();
            $table->string('event_title', 150);
            $table->string('event_type', 100)->nullable();
            $table->date('event_date')->nullable();
            $table->time('event_time')->nullable();
            $table->string('location', 150)->nullable();
            $table->text('description')->nullable();
            $table->string('contact_name', 150)->nullable();
            $table->string('contact_mobile', 30)->nullable();
            $table->unsignedInteger('expected_attendees')->nullable();
            $table->string('status', 30)->default('scheduled');
            $table->boolean('is_active')->default(true);
            $table->timestamps();

            $table->foreign('customer_id')->references('id')->on('customers')->onDelete('cascade');
            $table->index('company_id');
            $table->index('event_date');
            $table->index('status');
            $table->index('is_active');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('public_events');
    }
};
