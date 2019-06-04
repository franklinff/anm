<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAnmDetails extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::disableForeignKeyConstraints();
        Schema::create('anm_details', function (Blueprint $table) {
            $table->increments('id');
            $table->string('anm_name');
            $table->string('anm_mobile_number');
            $table->string('anm_translation')->collation('utf8_general_ci');
            $table->integer('phc_id')->unsigned();
            $table->integer('language_id')->unsigned();
            $table->boolean('status')->default(1);
            $table->timestamp('created_at')->nullable();

            $table->foreign('phc_id')->references('id')->on('phc');
            $table->foreign('language_id')->references('id')->on('master_language');
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
        Schema::dropIfExists('anm_details');
    }
}
