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
        Schema::create('case_hearings', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('case_id');
            $table->date('hearing_date')->nullable();
            $table->time('hearing_time')->nullable();
            $table->string('court_room', 100)->nullable();
            $table->string('hearing_status', 20)->default('scheduled');
            $table->date('next_hearing_date')->nullable();
            $table->text('outcome_notes')->nullable();
            $table->timestamps();

            $table->foreign('case_id')->references('id')->on('legal_cases')->onDelete('cascade');
            $table->index('hearing_date');
            $table->index('hearing_status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('case_hearings');
    }
};
