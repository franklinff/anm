<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePhc extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::disableForeignKeyConstraints();
        Schema::create('phc', function (Blueprint $table) {
            $table->increments('id');
            $table->string('phc_name');
            $table->string('phc_translation')->collation('utf8_general_ci');
            $table->integer('block_id')->unsigned();
            $table->integer('language_id')->unsigned();
            $table->boolean('status')->default(1);
            $table->timestamp('created_at')->nullable();

            $table->foreign('block_id')->references('id')->on('master_block');
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
        Schema::dropIfExists('phc');
    }
}
