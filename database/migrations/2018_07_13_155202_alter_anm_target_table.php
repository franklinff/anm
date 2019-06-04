<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterAnmTargetTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('anm_target_data', function(Blueprint $table){
            $table->string('block')->change();

            $table->string('phc_hin')->after('phc_name');
            $table->string('subcenter')->after('block');
            $table->string('moic_hin')->after('moic_name');
            $table->string('anm_hin')->after('anm_name');

            $table->tinyInteger('anm_sms_initiated')->after('anm_custom_msg')->default(0);
            $table->tinyInteger('moic_sms_initiated')->after('moic_custom_msg')->default(0);
            $table->tinyInteger('benef_sms_initiated')->after('beneficiary_custom_msg')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('anm_target_data', function(Blueprint $table){
            $table->integer('block')->nullable()->change();

            $table->dropColumn('phc_hin');
            $table->dropColumn('subcenter');
            $table->dropColumn('moic_hin');
            $table->dropColumn('anm_hin');

            $table->dropColumn('anm_sms_initiated');
            $table->dropColumn('moic_sms_initiated');
            $table->dropColumn('benef_sms_initiated');
        });
    }
}
