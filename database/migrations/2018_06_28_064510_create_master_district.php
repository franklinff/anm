<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMasterDistrict extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::disableForeignKeyConstraints();
        Schema::create('master_district', function (Blueprint $table) {
            $table->increments('id');
            $table->string('district_name');
            $table->integer('state_id')->unsigned();
            $table->boolean('status')->default(1);
            $table->timestamp('created_at')->nullable();
            $table->foreign('state_id')->references('id')->on('master_state');
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
        Schema::dropIfExists('master_district');
    }
}
