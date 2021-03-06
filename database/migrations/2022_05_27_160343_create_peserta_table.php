<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePesertaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('pesertas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_users');
            $table->string('instansi_peserta')->default('USNI');
            $table->date('tanggal_lahir')->nullable();
            $table->string('gender')->nullable(); // PRIA WANITA
            $table->string('domisili')->nullable();
            $table->string('no_telepon')->nullable();

            /* KHUSUS MAHASISWA USNI */
            $table->foreignId('id_fakultas')->nullable();
            $table->string('jurusan_peserta')->nullable();
            $table->string('angkatan')->nullable();


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
        Schema::dropIfExists('pesertas');
    }
}
