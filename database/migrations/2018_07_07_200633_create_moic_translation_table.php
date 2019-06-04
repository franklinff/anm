<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMoicTranslationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::disableForeignKeyConstraints();
        Schema::create('moic_translation', function (Blueprint $table) {
            $table->increments('id');
            $table->string('moic_name');
            $table->string('moic_mobile_number');
            $table->string('moic_translation')->collation('utf8_general_ci');
            $table->integer('phc_id')->unsigned();
            $table->integer('district_id')->unsigned();
            $table->integer('language_id')->unsigned();
            $table->boolean('status')->default(1);
            $table->timestamp('created_at')->nullable();

            $table->foreign('phc_id')->references('id')->on('phc');
            $table->foreign('district_id')->references('id')->on('master_district');
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
        Schema::dropIfExists('moic_translation');
    }
}
