<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddStatusColumnIntoPemesananGaunTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         Schema::table('pemesanan_gaun', function (Blueprint $table) {
            $table->enum('status', ['diproses', 'berjalan', 'selesai'])->default('diproses');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
         Schema::table('pemesanan_gaun', function (Blueprint $table) {
            $table->dropColumn('status');
        });
    }
}
