<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (Schema::hasTable('profile_pdf_jobs')) {
            return;
        }

        Schema::create('profile_pdf_jobs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('customer_id');
            $table->string('slug');
            $table->string('profile_url');
            $table->string('status')->default('queued');
            $table->string('file_path')->nullable();
            $table->text('error_message')->nullable();
            $table->timestamps();

            $table->index(['customer_id', 'status']);
            $table->index('slug');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('profile_pdf_jobs');
    }
};
