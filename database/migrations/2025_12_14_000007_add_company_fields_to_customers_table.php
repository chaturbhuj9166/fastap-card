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
        Schema::table('customers', function (Blueprint $table) {
            $table->tinyInteger('profession_type')->default(0)->comment('1-13 theme type')->after('profession');
            $table->unsignedBigInteger('company_id')->nullable()->after('id');
            $table->tinyInteger('is_company_admin')->default(0)->after('company_id');
            $table->enum('account_type', ['individual', 'company', 'staff'])->default('individual')->after('is_company_admin');

            $table->index('company_id');
            $table->index('profession_type');
            $table->index('account_type');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('customers', function (Blueprint $table) {
            $table->dropIndex(['company_id']);
            $table->dropIndex(['profession_type']);
            $table->dropIndex(['account_type']);
            $table->dropColumn(['profession_type', 'company_id', 'is_company_admin', 'account_type']);
        });
    }
};
