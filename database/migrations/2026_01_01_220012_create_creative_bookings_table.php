<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCreativeBookingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('creative_bookings', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('customer_id');
            $table->unsignedBigInteger('package_id')->nullable();
            $table->string('client_name');
            $table->string('client_mobile');
            $table->string('client_email')->nullable();
            $table->enum('service_type', ['photography', 'event', 'combined'])->default('photography');
            $table->date('event_date');
            $table->time('event_time')->nullable();
            $table->string('event_type')->nullable(); // Wedding, Birthday, Corporate, etc.
            $table->integer('guest_count')->nullable();
            $table->decimal('budget', 10, 2)->nullable();
            $table->text('venue')->nullable();
            $table->text('special_requirements')->nullable();
            $table->enum('status', ['pending', 'confirmed', 'completed', 'cancelled'])->default('pending');
            $table->enum('payment_status', ['pending', 'partial', 'paid', 'refunded'])->default('pending');
            $table->decimal('payment_amount', 10, 2)->nullable();
            $table->text('notes')->nullable();
            $table->timestamps();

            $table->foreign('customer_id')->references('id')->on('customers')->onDelete('cascade');
            $table->foreign('package_id')->references('id')->on('creative_packages')->onDelete('set null');
            $table->index('customer_id');
            $table->index('status');
            $table->index('event_date');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('creative_bookings');
    }
}
