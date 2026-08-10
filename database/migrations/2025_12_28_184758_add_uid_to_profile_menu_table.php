<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddUidToProfileMenuTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('profile_menu', function (Blueprint $table) {
            $table->bigInteger('uid')->nullable()->after('id')->comment('Customer ID');
            $table->index('uid');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('profile_menu', function (Blueprint $table) {
            $table->dropIndex(['uid']);
            $table->dropColumn('uid');
        });
    }
}
