<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHutangsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hutang', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('pembelian_id')->nullable();
            $table->unsignedBigInteger('supplier_id')->nullable();
            $table->date('jatuh_tempo');
            $table->date('tanggal_lunas')->nullable();
            $table->enum('status_lunas', ['Belum Lunas', 'Bank', 'Cash'])->default('Belum Lunas');
            $table->double('nominal', 16,0)->default(0);
            $table->timestamps();

            $table->foreign('pembelian_id')->references('id')->on('pembelian')->nullOnDelete();
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
        Schema::dropIfExists('hutang');
    }
}
