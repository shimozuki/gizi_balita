<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddLilaAndLingkarkepalaToBalitaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('balita', function (Blueprint $table) {
            $table->string('status_lila')->nullable();
            $table->float('bobot_lila')->nullable();

            $table->string('status_lingkarkepala')->nullable();
            $table->float('bobot_lingkarkepala')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('balita', function (Blueprint $table) {
            //
        });
    }
}
