<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSuppliersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('supplier', function (Blueprint $table) {
            $table->id();
            $table->string('nama', 70);
            $table->string('kode', 30)->nullable();
            $table->string('email')->nullable();
            $table->string('no_hp', 17)->nullable();
            $table->string('no_telepon', 17)->nullable();
            $table->string('kota', 30)->nullable();
            $table->text('alamat')->nullable();
            $table->integer('diskon')->nullable()->default(0);
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
        Schema::dropIfExists('supplier');
    }
}
