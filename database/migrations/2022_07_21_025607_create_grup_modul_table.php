<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGrupModulTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('grup_modul', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('grup_id');
            $table->unsignedBigInteger('modul_id');
            $table->timestamps();

            $table->foreign('grup_id')->references('id')->on('grup')->onDelete('cascade');
            $table->foreign('modul_id')->references('id')->on('modul')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('grup_modul');
    }
}
