<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTablesSmsLogs extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('moic_ranking', function(Blueprint $table){
            $table->tinyInteger('sms_sent_initiated')->after('sms')->default(0);
        });
        Schema::create('mois_anm_sms_logs', function (Blueprint $table) {
            $table->increments('id');
            $table->string('filename');
            $table->string('dr_name', 50)->nullable();
            $table->string('anm_name', 50)->nullable();
            $table->bigInteger('mobile');
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
        Schema::table('moic_ranking', function(Blueprint $table){
            $table->dropColumn('sms_sent_initiated');
        });
        Schema::dropIfExists('mois_anm_sms_logs');
    }
}
