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
        Schema::create('pohon_foto', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pohon_id');
            $table->string('foto');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('pohon_id')->references('id')->on('pohon')
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
        Schema::dropIfExists('pohon_foto');
    }
};
