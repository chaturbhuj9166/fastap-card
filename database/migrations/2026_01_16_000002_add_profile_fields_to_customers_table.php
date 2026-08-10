<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('customers', function (Blueprint $table) {
            if (!Schema::hasColumn('customers', 'dob')) {
                $table->date('dob')->nullable()->after('mobile');
            }
            if (!Schema::hasColumn('customers', 'whatsapp')) {
                $table->string('whatsapp', 30)->nullable()->after('mobile');
            }
            if (!Schema::hasColumn('customers', 'country')) {
                $table->string('country', 255)->nullable()->after('state');
            }
            if (!Schema::hasColumn('customers', 'website')) {
                $table->string('website', 255)->nullable()->after('country');
            }
            if (!Schema::hasColumn('customers', 'bio')) {
                $table->string('bio', 255)->nullable()->after('title1');
            }
            if (!Schema::hasColumn('customers', 'about')) {
                $table->text('about')->nullable()->after('bio');
            }
            if (!Schema::hasColumn('customers', 'profession_data')) {
                $table->json('profession_data')->nullable()->after('profession_type');
            }
        });
    }

    public function down(): void
    {
        Schema::table('customers', function (Blueprint $table) {
            $table->dropColumn([
                'dob',
                'whatsapp',
                'country',
                'website',
                'bio',
                'about',
                'profession_data',
            ]);
        });
    }
};
