<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePenjualansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('penjualan', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('pelanggan_id')->nullable();
            $table->string('no_faktur', 20);
            $table->date('tanggal');
            $table->double('sub_total', 16,0)->default(0);
            $table->double('potongan', 16,0)->default(0);
            $table->double('ppn', 16,0)->default(0);
            $table->double('total', 16,0)->default(0);
            $table->double('bayar', 16,0)->default(0);
            $table->double('kembali', 16,0)->default(0);
            $table->enum('tipe_pembayaran', ['Debit Card', 'Credit Card', 'Voucher', 'Piutang', 'Cash', 'Transfer'])->default('Cash');
            $table->timestamps();

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
        Schema::dropIfExists('penjualan');
    }
}
