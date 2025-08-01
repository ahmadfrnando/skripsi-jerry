<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGaunTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gaun', function (Blueprint $table) {
            $table->id();
            $table->string("nama_gaun");
            $table->tinyInteger("star")->default(0);
            $table->text("deskripsi");
            $table->bigInteger("harga")->default(0);
            $table->text("foto_gaun");
            $table->enum("status", ["tersedia", "tersewa"])->default("tersedia");
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
        Schema::dropIfExists('gaun');
    }
}
