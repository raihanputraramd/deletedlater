<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePiutangBarangsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('piutang_barang', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('piutang_id');
            $table->unsignedBigInteger('barang_id')->nullable();
            $table->timestamps();

            $table->foreign('piutang_id')->references('id')->on('piutang')->onDelete('cascade');
            $table->foreign('barang_id')->references('id')->on('barang')->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('piutang_barang');
    }
}
