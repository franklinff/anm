<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMasterMonths extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::disableForeignKeyConstraints();

        Schema::create('master_months', function (Blueprint $table) {
            $table->increments('id');
            $table->string('month_english');
            $table->string('month_translated')->collation('utf8_general_ci');
            $table->integer('language_id')->unsigned();
            $table->timestamp('created_at')->nullable();
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
        Schema::dropIfExists('master_months');
    }
}
