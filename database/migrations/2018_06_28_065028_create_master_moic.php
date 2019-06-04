<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMasterMoic extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::disableForeignKeyConstraints();
        Schema::create('master_moic', function (Blueprint $table) {
            $table->increments('id');
            $table->string('moic_name');
            $table->string('moic_mobile_number');
            $table->integer('phc_id')->unsigned();
            $table->timestamp('created_at')->nullable();

            $table->foreign('phc_id')->references('id')->on('phc');
        });
        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('master_moic');
    }
}
