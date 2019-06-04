<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class SmsFeed extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('patient_feedback', function (Blueprint $table) {
            $table->string('sms')->after('fill_rate')->collation('utf8_general_ci');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('patient_feedback', function (Blueprint $table) {
            $table->string('sms')->after('fill_rate')->collation('utf8_general_ci');
        });
    }
}
