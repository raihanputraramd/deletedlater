<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePiutangsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('piutang', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('penjualan_id')->nullable();
            $table->unsignedBigInteger('pelanggan_id')->nullable();
            $table->string('nik')->nullable();
            $table->date('jatuh_tempo');
            $table->date('tanggal_lunas')->nullable();
            $table->enum('status_lunas', ['Belum Lunas', 'Bank', 'Cash'])->default('Belum Lunas');
            $table->double('nominal', 16,0)->default(0);
            $table->timestamps();

            $table->foreign('penjualan_id')->references('id')->on('penjualan')->nullOnDelete();
            $table->foreign('pelanggan_id')->references('id')->on('pelanggan')->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('piutang');
    }
}
