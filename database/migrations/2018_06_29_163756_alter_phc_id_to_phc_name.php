<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterPhcIdToPhcName extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('beneficary_details', function (Blueprint $table) {
            $table->dropForeign(['phc_id']);
            $table->renameColumn('phc_id', 'phc_name')->change();
            $table->integer('district_id')->unsigned()->nullable()->after('beneficary_mobile_number');
            $table->string('beneficary_mobile_number')->nullable()->change();
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('beneficary_details', function (Blueprint $table) {
            //
        });
    }
}
