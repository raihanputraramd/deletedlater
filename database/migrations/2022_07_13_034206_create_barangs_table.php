<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBarangsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('barang', function (Blueprint $table) {
            $table->id();
            $table->string('kode', 30);
            $table->string('nama', 70);
            $table->double('harga_beli', 16,0)->default(0);
            $table->integer('diskon_beli')->default(0)->nullable();
            $table->integer('berat')->default(0)->nullable();
            $table->integer('omset')->default(0)->nullable();
            $table->string('size')->nullable();
            $table->text('deskripsi')->nullable();
            $table->string('gambar')->default('noimage.png')->nullable();
            $table->unsignedBigInteger('supplier_id')->nullable();
            $table->timestamps();

            $table->foreign('supplier_id')->references('id')->on('supplier')->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('barang');
    }
}
