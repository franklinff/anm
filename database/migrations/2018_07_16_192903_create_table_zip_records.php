<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableZipRecords extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ranking_zip_files', function (Blueprint $table) {
            $table->increments('id');
            $table->tinyInteger('month');
            $table->integer('year');
            $table->string('zip_file');
            $table->tinyInteger('is_extracted')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ranking_zip_files');
    }
}
