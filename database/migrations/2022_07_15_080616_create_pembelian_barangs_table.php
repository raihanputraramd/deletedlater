<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePembelianBarangsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pembelian_barang', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('pembelian_id')->nullable();
            $table->unsignedBigInteger('barang_id')->nullable();
            $table->date('tanggal');
            $table->double('harga', 16,0)->default(0);
            $table->integer('banyak');
            $table->double('sub_total', 16,0)->default(0);
            $table->double('diskon', 16,0)->default(0);
            $table->double('total', 16,0)->default(0);
            $table->timestamps();

            $table->foreign('pembelian_id')->references('id')->on('pembelian')->onDelete('cascade');
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
        Schema::dropIfExists('pembelian_barang');
    }
}
