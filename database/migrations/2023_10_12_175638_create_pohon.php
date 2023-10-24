<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('pohon', function (Blueprint $table) {
            $table->id();
            $table->string('nama_indo');
            $table->string('nama_latin')->nullable();
            $table->string('kode_kec')->nullable();
            $table->string('kode_kel')->nullable();
            $table->string('latitude')->nullable();
            $table->string('longitude')->nullable();
            $table->string('kode')->nullable();
            $table->point('koordinat')->nullable();;
            $table->string('jenis_id')->nullable();
            $table->string('lokasi')->nullable();
            $table->decimal('tinggi')->nullable();
            $table->decimal('diameter')->nullable();
            $table->string('akar')->nullable();
            $table->string('kondisi')->nullable();
            $table->text('detail')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('pohon');
    }
};
