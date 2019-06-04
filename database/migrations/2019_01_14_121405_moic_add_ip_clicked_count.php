<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MoicAddIpClickedCount extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('moic_logs', function (Blueprint $table) {
            $table->string('ip_address2')->after('clicked_at')->nullable();
            $table->string('clicked_at2')->after('ip_address2')->nullable();
            $table->string('ip_address3')->after('clicked_at2')->nullable();
            $table->string('clicked_at3')->after('ip_address3')->nullable();
            $table->integer('click_count')->after('mobile_no')->default(0);
            $table->string('clicked_at')->change()->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('moic_logs', function (Blueprint $table) {
            $table->dropColumn('ip_address2');
            $table->dropColumn('clicked_at2');
            $table->dropColumn('ip_address3');
            $table->dropColumn('clicked_at3');
            $table->dropColumn('click_count');
        });
    }
}
