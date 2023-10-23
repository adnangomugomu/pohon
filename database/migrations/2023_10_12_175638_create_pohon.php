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
            $table->string('kode')->nullable();
            $table->string('kode_desa')->nullable();
            $table->point('koordinat')->nullable();;
            $table->string('lokasi')->nullable();
            $table->string('nama_latin')->nullable();
            $table->string('jenis_id')->nullable();
            $table->decimal('tinggi')->nullable();
            $table->decimal('diameter')->nullable();
            $table->decimal('akar')->nullable();
            $table->text('kondisi')->nullable();
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
