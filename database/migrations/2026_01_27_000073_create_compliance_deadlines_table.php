<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('compliance_deadlines', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('customer_id')->index();
            $table->unsignedBigInteger('company_id')->nullable()->index();
            $table->string('client_mobile', 30)->nullable();
            $table->string('compliance_type', 30)->nullable();
            $table->string('financial_year', 20)->nullable();
            $table->date('due_date')->nullable();
            $table->boolean('reminder_sent')->default(false);
            $table->string('status', 30)->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('compliance_deadlines');
    }
};
