<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterBlockAnmTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('anm_target_data', function (Blueprint $table) {
            $table->integer('district')->nullable()->change();
            $table->integer('block')->nullable()->change();
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
            $table->string('district')->change();
            $table->string('block')->change();
        });
    }
}
