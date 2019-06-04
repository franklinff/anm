<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddIpWeblinkCountAnm extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('anm_weblink_logs', function (Blueprint $table) {
            $table->string('ip_address2')->after('clicked_at')->nullable();
            $table->timestamp('clicked_at2')->after('ip_address2')->nullable();;
            $table->string('ip_address3')->after('clicked_at2')->nullable();
            $table->timestamp('clicked_at3')->after('ip_address3')->nullable();
            $table->integer('click_count')->after('mobile_no')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('anm_weblink_logs', function (Blueprint $table) {
            $table->dropColumn('ip_address2');
            $table->dropColumn('clicked_at2');
            $table->dropColumn('ip_address3');
            $table->dropColumn('clicked_at3');
            $table->dropColumn('click_count');
        });
    }
}
