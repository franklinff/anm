<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DropColumnTargetData extends Migration
{
    /**
     * Run the migrations.
     * droped subcenter_name from anm_target_data table as it was not required.
     * @return void
     */
    public function up()
    {
        Schema::table('anm_target_data', function (Blueprint $table) {
            $table->dropColumn('subcenter_name');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('anm_target_data', function (Blueprint $table) {
            $table->string('subcenter_name');
        });
    }
}
