<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePembeliansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pembelian', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('supplier_id')->nullable();
            $table->string('no_faktur', 20);
            $table->date('tanggal');
            $table->double('sub_total', 16,0)->default(0);
            $table->double('potongan', 16,0)->default(0);
            $table->double('ppn', 16,0)->default(0);
            $table->double('total', 16,0)->default(0);
            $table->enum('tipe_pembayaran', ['Debit Card', 'Credit Card', 'Voucher', 'Hutang', 'Cash', 'Transfer'])->default('Cash');
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
        Schema::dropIfExists('pembelian');
    }
}
