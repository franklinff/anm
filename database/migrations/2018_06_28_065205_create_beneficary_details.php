<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBeneficaryDetails extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('beneficary_details', function (Blueprint $table) {
            $table->increments('id');
            $table->string('beneficary_mobile_number');
            $table->integer('phc_id')->unsigned();
            $table->timestamp('created_at')->nullable();

            $table->foreign('phc_id')->references('id')->on('phc');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('beneficary_details');
    }
}
