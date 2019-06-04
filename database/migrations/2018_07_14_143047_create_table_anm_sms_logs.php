<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableAnmSmsLogs extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('anm_mos_smslogs', function (Blueprint $table) {
            $table->increments('id');
            $table->string('filename');
            $table->string('name', 50)->nullable();
            $table->bigInteger('mobile');
            $table->enum('type', ['anm', 'moic', 'beneficiary']);
            $table->tinyInteger('is_sent')->default(0);
            $table->string('sms', 1000);
            $table->dateTime('sent_at')->nullable();
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
        Schema::dropIfExists('anm_mos_smslogs');
    }
}
