<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFootersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('footer', function (Blueprint $table) {
            $table->id();
            $table->string('judul_alamat');
            $table->string('judul_telepon');
            $table->string('judul_email');
            $table->string('judul_marketplace');
            $table->text('alamat');
            $table->string('jam_buka', 191);
            $table->string('telepon_1', 30);
            $table->string('telepon_2', 30);
            $table->string('email_1');
            $table->string('email_2');

            $table->string('marketplace_1_nama');
            $table->string('marketplace_1_link');
            $table->string('marketplace_2_nama');
            $table->string('marketplace_2_link');
            $table->string('marketplace_3_nama');
            $table->string('marketplace_3_link');

            $table->string('icon_alamat')->nullable()->default('noimage.png');
            $table->string('icon_telepon')->nullable()->default('noimage.png');
            $table->string('icon_email')->nullable()->default('noimage.png');
            $table->string('icon_marketplace')->nullable()->default('noimage.png');

            $table->string('sosial_1_gambar')->nullable()->default('footer-facebook.svg');
            $table->string('sosial_1_link');
            $table->string('sosial_2_gambar')->nullable()->default('footer-youtube.svg');
            $table->string('sosial_2_link');
            $table->string('sosial_3_gambar')->nullable()->default('footer-instagram.svg');
            $table->string('sosial_3_link');
            $table->string('sosial_4_gambar')->nullable()->default('footer-tiktok.svg');
            $table->string('sosial_4_link');

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
        Schema::dropIfExists('footer');
    }
}
