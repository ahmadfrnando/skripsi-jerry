<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePemesananGaunTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pemesanan_gaun', function (Blueprint $table) {
            $table->id();
            $table->integer('id_gaun');
            $table->integer('id_user');
            $table->date('tanggal_sewa_mulai');
            $table->date('tanggal_sewa_selesai');
            $table->string('nama_pemesan');
            $table->integer('total_harga');
            $table->string('no_hp');
            $table->string('alamat');
            $table->text('catatan')->nullable();
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
        Schema::dropIfExists('pemesanan_gaun');
    }
}
