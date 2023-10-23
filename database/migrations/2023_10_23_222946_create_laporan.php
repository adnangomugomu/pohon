<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('laporan', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pohon_id');
            $table->foreignId('status_id');
            $table->enum('jenis', ['masyarakat', 'internal']);
            $table->string('nama');
            $table->string('no_hp');
            $table->string('email');
            $table->text('deskripsi');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('pohon_id')->references('id')->on('pohon')
                ->onUpdate('cascade')->onDelete('cascade');

            $table->foreign('status_id')->references('id')->on('ref_status')
                ->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('laporan');
    }
};
