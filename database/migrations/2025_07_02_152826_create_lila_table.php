<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLilaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lila', function (Blueprint $table) {
            $table->id();
            $table->integer('umur'); // umur dalam bulan
            $table->double('min3sd', 8, 2);
            $table->double('min2sd', 8, 2);
            $table->double('min1sd', 8, 2);
            $table->double('median', 8, 2);
            $table->double('plus1sd', 8, 2);
            $table->double('plus2sd', 8, 2);
            $table->double('plus3sd', 8, 2);
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
        Schema::dropIfExists('lila');
    }
}
