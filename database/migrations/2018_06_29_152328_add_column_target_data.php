<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnTargetData extends Migration
{
    /**
     * Run the migrations.
     * Added column filename,uploaded_on,status
     * @return void
     */
    public function up()
    {
        Schema::table('anm_target_data', function (Blueprint $table) {
            $table->string('filename');
            $table->string('uploaded_on');
            $table->char('status')->default('N');
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
            $table->string('filename');
            $table->string('uploaded_on');
            $table->char('status')->default('N');
        });
    }
}
