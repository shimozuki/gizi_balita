<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLingkarKepalaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lingkar_kepala', function (Blueprint $table) {
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
        Schema::dropIfExists('lingkar_kepala');
    }
}
