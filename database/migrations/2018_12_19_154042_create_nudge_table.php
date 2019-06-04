<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNudgeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('nudges', function (Blueprint $table) {
            $table->increments('id');
            $table->string('phone_no');
            $table->string('message');
            $table->tinyInteger('sms_sent')->default(0);
            $table->string('og_filename');
            $table->string('filename');
            $table->dateTime('schedule_at');
            $table->timestamp('created_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('nudges');
    }
}
