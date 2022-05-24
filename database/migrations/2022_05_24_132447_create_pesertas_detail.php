<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePesertasDetail extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('peserta_details', function (Blueprint $table) {
            $table->id();

            $table->foreignId('id_peserta')->constrained('pesertas');

            $table->string('jurusan');
            $table->string('tahun_masuk');
            $table->string('semester_masuk');
            $table->string('no_telp');
            $table->string('fakultas'); 
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
        Schema::dropIfExists('peserta_details');
    }
}
