<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterPhcIdToDistrictId extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('anm_details', function (Blueprint $table) {
            $table->dropForeign(['phc_id']);
            $table->renameColumn('phc_id', 'district_id')->change();

        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('anm_details', function (Blueprint $table) {
            //
        });
    }
}
