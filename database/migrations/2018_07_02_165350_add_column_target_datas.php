<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnTargetDatas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('anm_target_data', function (Blueprint $table) {
            $table->string('og_filename');
            $table->string('weblink')->nullable();
            $table->string('sms')->collation('utf8_general_ci')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('anm_target_data', function (Blueprint $table) {
            $table->string('og_filename');
            $table->string('weblink')->nullable();
            $table->string('sms')->collation('utf8_general_ci')->nullable();
        });
    }
}
