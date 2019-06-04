<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBlock extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::disableForeignKeyConstraints();
        Schema::create('master_block', function (Blueprint $table) {
            $table->increments('id');
            $table->string('block_name');
            $table->integer('district_id')->unsigned();
            $table->timestamp('created_at')->nullable();
            $table->boolean('status')->default(1);
            $table->foreign('district_id')->references('id')->on('master_district');
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
        Schema::dropIfExists('master_block');
    }
}
