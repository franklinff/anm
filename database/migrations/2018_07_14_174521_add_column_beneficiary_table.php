<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnBeneficiaryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('beneficary_details', function(Blueprint $table){
            $table->tinyInteger('benef_sms_initiated')->default(0);
        });
        Schema::table('anm_target_data', function(Blueprint $table){
            $table->dropColumn('benef_sms_initiated');
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
            $table->tinyInteger('benef_sms_initiated')->after('beneficiary_custom_msg')->default(0);
        });
        Schema::table('beneficary_details', function(Blueprint $table){
            $table->dropColumn('benef_sms_initiated');
        });
    }
}
