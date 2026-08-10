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
        Schema::create('companies', function (Blueprint $table) {
            $table->id();
            $table->string('name', 255);
            $table->string('slug', 255)->unique()->nullable();
            $table->string('email', 255);
            $table->string('password', 255);
            $table->string('phone', 20)->nullable();
            $table->string('logo', 255)->nullable();
            $table->string('banner', 255)->nullable();
            $table->text('description')->nullable();
            $table->tinyInteger('profession_type')->default(1)->comment('1-13 profession theme');
            $table->string('industry', 100)->nullable();
            $table->string('website', 255)->nullable();
            $table->text('address')->nullable();
            $table->string('city', 100)->nullable();
            $table->string('state', 100)->nullable();
            $table->string('country', 100)->nullable();
            $table->string('pincode', 20)->nullable();
            $table->string('gst_number', 50)->nullable();
            $table->string('facebook', 255)->nullable();
            $table->string('instagram', 255)->nullable();
            $table->string('twitter', 255)->nullable();
            $table->string('linkedin', 255)->nullable();
            $table->string('youtube', 255)->nullable();
            $table->integer('card_limit')->default(10)->comment('Max cards allowed');
            $table->integer('cards_used')->default(0);
            $table->tinyInteger('status')->default(1)->comment('0=inactive, 1=active');
            $table->enum('subscription_type', ['free', 'basic', 'premium', 'enterprise'])->default('free');
            $table->date('subscription_expires')->nullable();
            $table->json('branding_settings')->nullable()->comment('Colors, fonts, etc.');
            $table->integer('created_by')->nullable()->comment('Admin/Agent who created');
            $table->timestamps();

            $table->index('email');
            $table->index('status');
            $table->index('profession_type');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('companies');
    }
};
