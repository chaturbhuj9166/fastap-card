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
        Schema::create('event_bookings', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('customer_id');
            $table->unsignedBigInteger('company_id')->nullable();
            $table->string('client_name', 150)->nullable();
            $table->string('client_mobile', 20)->nullable();
            $table->string('client_email', 150)->nullable();
            $table->string('event_type', 100)->nullable();
            $table->date('event_date')->nullable();
            $table->string('time_slot', 50)->nullable();
            $table->integer('guest_count')->nullable();
            $table->string('venue_area', 100)->nullable();
            $table->string('food_preference', 50)->nullable();
            $table->string('decoration_theme', 100)->nullable();
            $table->json('entertainment')->nullable();
            $table->string('photography_package', 100)->nullable();
            $table->json('catering_menu')->nullable();
            $table->decimal('total_amount', 10, 2)->nullable();
            $table->decimal('advance_paid', 10, 2)->nullable();
            $table->decimal('balance_amount', 10, 2)->nullable();
            $table->string('booking_status', 20)->default('inquiry');
            $table->text('special_requirements')->nullable();
            $table->timestamps();

            $table->foreign('customer_id')->references('id')->on('customers')->onDelete('cascade');
            $table->index('company_id');
            $table->index('event_date');
            $table->index('booking_status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('event_bookings');
    }
};
