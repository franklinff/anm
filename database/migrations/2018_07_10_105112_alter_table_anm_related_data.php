<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterTableAnmRelatedData extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('anm_target_data', function (Blueprint $table) {
            $table->renameColumn('sms', 'anm_custom_msg')->string('anm_custom_msg', 2000)->change();
            $table->string('moic_custom_msg', 255)->nullable();
            $table->string('beneficiary_custom_msg', 255)->nullable();
            $table->tinyInteger('month')->nullable();
            $table->integer('year')->nullable();
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
            $table->renameColumn('anm_custom_msg', 'sms')->change();
            $table->dropColumn('moic_custom_msg');
            $table->dropColumn('beneficiary_custom_msg');
            $table->dropColumn('month');
            $table->dropColumn('year');
        });
    }
}
