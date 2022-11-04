<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBarangHargasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('barang_harga', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('barang_id');
            $table->double('harga_jual', 16,0)->default(0);
            $table->double('harga_jual_1', 16,0)->default(0)->nullable();
            $table->double('harga_jual_2', 16,0)->default(0)->nullable();
            $table->double('harga_jual_3', 16,0)->default(0)->nullable();
            $table->timestamps();

            $table->foreign('barang_id')->references('id')->on('barang')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('barang_harga');
    }
}
