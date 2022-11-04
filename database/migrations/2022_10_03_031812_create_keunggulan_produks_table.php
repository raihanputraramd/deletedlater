<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKeunggulanProduksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('keunggulan_produk', function (Blueprint $table) {
            $table->id();
            $table->string('judul');
            $table->string('keunggulan_1_judul');
            $table->text('keunggulan_1_deskripsi');

            $table->string('keunggulan_2_judul');
            $table->text('keunggulan_2_deskripsi');
            
            $table->string('keunggulan_3_judul');
            $table->text('keunggulan_3_deskripsi');

            $table->string('gambar')->default('noimage.png')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('keunggulan_produk');
    }
}
