<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMedicalPaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('medical_payments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('customer_id'); // Doctor/Hospital
            $table->unsignedBigInteger('appointment_id')->nullable();

            // Patient details
            $table->string('patient_name');
            $table->string('patient_mobile', 15);
            $table->string('patient_email')->nullable();

            // Payment details
            $table->string('service_type'); // Consultation, Test, Procedure, etc.
            $table->decimal('amount', 10, 2);
            $table->decimal('discount', 10, 2)->default(0);
            $table->decimal('final_amount', 10, 2);

            // Payment method
            $table->enum('payment_mode', ['upi', 'card', 'cash', 'bank_transfer', 'online_gateway'])->default('upi');
            $table->string('upi_transaction_id')->nullable();
            $table->string('payment_gateway_transaction_id')->nullable();
            $table->string('payment_screenshot')->nullable(); // Path to uploaded screenshot

            // Status
            $table->enum('status', ['pending', 'completed', 'failed', 'refunded'])->default('pending');
            $table->timestamp('paid_at')->nullable();

            // Receipt
            $table->string('receipt_number')->unique()->nullable();
            $table->string('receipt_url')->nullable();
            $table->text('invoice_details')->nullable(); // JSON for invoice data

            // GST details (if applicable)
            $table->string('gst_number')->nullable();
            $table->decimal('gst_amount', 10, 2)->nullable();

            $table->foreign('customer_id')->references('id')->on('customers')->onDelete('cascade');
            $table->foreign('appointment_id')->references('id')->on('medical_appointments')->onDelete('set null');
            $table->timestamps();

            $table->index(['customer_id', 'created_at']);
            $table->index(['patient_mobile']);
            $table->index(['receipt_number']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('medical_payments');
    }
}
