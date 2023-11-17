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
            $table->point('koordinat')->nullable();
            $table->foreignId('jenis_id')->nullable();
            $table->string('lokasi')->nullable();
            $table->decimal('tinggi')->nullable();
            $table->decimal('diameter')->nullable();
            $table->foreignId('akar_id')->nullable();
            $table->foreignId('kondisi_id')->nullable();
            $table->foreignId('tajuk_id')->nullable();
            $table->decimal('utara')->nullable();
            $table->decimal('timur')->nullable();
            $table->decimal('selatan')->nullable();
            $table->decimal('barat')->nullable();
            $table->text('detail')->nullable();
            $table->enum('is_verif', ['0', '1'])->default('0');
            $table->date('tgl_verif')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('jenis_id')->references('id')->on('ref_jenis')
                ->onUpdate('cascade')->onDelete('cascade');

            $table->foreign('akar_id')->references('id')->on('ref_akar')
                ->onUpdate('cascade')->onDelete('cascade');

            $table->foreign('kondisi_id')->references('id')->on('ref_kondisi')
                ->onUpdate('cascade')->onDelete('cascade');

            $table->foreign('tajuk_id')->references('id')->on('ref_tajuk')
                ->onUpdate('cascade')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('pohon');
    }
};
