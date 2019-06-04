<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAnmTargetData extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('anm_target_data', function (Blueprint $table) {
            $table->increments('id');

            $table->string('district');
            $table->string('block');
            $table->string('phc_name');
            $table->string('subcenter_name');
            $table->string('moic_name');
            $table->string('moic_mobile_number');
            $table->string('anm_name');
            $table->string('anm_mobile_number');
            $table->string('performer_category');
            $table->string('scenerio');

            $table->timestamp('created_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('anm_target_data');
    }
}
