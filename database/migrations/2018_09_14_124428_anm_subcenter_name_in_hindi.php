<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AnmSubcenterNameInHindi extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('anm_target_data', function (Blueprint $table) {
            $table->string('subcenter_hindi')->after('subcenter');
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
            $table->string('subcenter_hindi')->after('subcenter');
        });
    }
}
