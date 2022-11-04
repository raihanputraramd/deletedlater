<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBarangStoksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('barang_stok', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('barang_id');
            $table->integer('stok')->default(0);
            $table->enum('satuan_1', ['pcs', 'lusin', 'kodi', 'pak', 'dus', 'box'])->default('pcs');
            $table->enum('satuan_2', ['pcs', 'lusin', 'kodi', 'pak', 'dus', 'box'])->nullable();
            $table->integer('isi_satuan_2')->default(0)->nullable();
            $table->enum('satuan_3', ['pcs', 'lusin', 'kodi', 'pak', 'dus', 'box'])->nullable();
            $table->integer('isi_satuan_3')->default(0)->nullable();
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
        Schema::dropIfExists('barang_stok');
    }
}
