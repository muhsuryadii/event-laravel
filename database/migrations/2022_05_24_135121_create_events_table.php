<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_panitia');
            $table->string('uuid', 32)->unique();
            $table->string('nama_event');
            $table->integer('harga_tiket');
            $table->dateTime('waktu_acara');
            $table->string('lokasi_acara');
            $table->string('tipe_acara');
            $table->integer('kuota_tiket');
            $table->string('famplet_acara_path', 2048)->nullable();
            $table->longText('deskripsi_acara');
            $table->integer('kuota')->nullable();
            $table->boolean('is_certificate_ready')->default(false);
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
        Schema::dropIfExists('events');
    }
}
