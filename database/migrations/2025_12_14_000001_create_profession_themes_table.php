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
        Schema::create('profession_themes', function (Blueprint $table) {
            $table->tinyIncrements('id');
            $table->string('name', 100);
            $table->string('slug', 50)->unique();
            $table->text('description')->nullable();
            $table->string('icon', 100)->nullable()->comment('Font Awesome or custom icon');
            $table->string('color', 7)->nullable()->comment('Primary theme color hex');
            $table->string('view_template', 100)->nullable()->comment('Blade template name');
            $table->json('required_fields')->nullable()->comment('Fields required for this theme');
            $table->json('optional_fields')->nullable()->comment('Optional fields for this theme');
            $table->string('sample_image', 255)->nullable();
            $table->tinyInteger('status')->default(1);
            $table->integer('sort_order')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('profession_themes');
    }
};
