<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBarangDiskonsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('barang_diskon', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('barang_id');
            $table->integer('diskon_jual')->default(0)->nullable();
            $table->double('diskon_amount_1', 16,0)->default(0)->nullable();
            $table->double('diskon_amount_2', 16,0)->default(0)->nullable();
            $table->double('diskon_amount_3', 16,0)->default(0)->nullable();
            $table->double('diskon_amount_4', 16,0)->default(0)->nullable();

            $table->integer('diskon_qty_1')->default(0)->nullable();
            $table->integer('diskon_qty_persen_1')->default(0)->nullable();
            
            $table->integer('diskon_qty_2')->default(0)->nullable();
            $table->integer('diskon_qty_persen_2')->default(0)->nullable();
            
            $table->integer('diskon_qty_3')->default(0)->nullable();
            $table->integer('diskon_qty_persen_3')->default(0)->nullable();
            
            $table->integer('diskon_qty_4')->default(0)->nullable();
            $table->integer('diskon_qty_persen_4')->default(0)->nullable();
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
        Schema::dropIfExists('barang_diskon');
    }
}
