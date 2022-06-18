<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransaksisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transaksis', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('id_event');
            $table->bigInteger('id_peserta');
            $table->dateTime('tanggal_transaksi')->default(now());
            $table->integer('total_harga');

            $table->string('no_transaksi');
            $table->string('status_transaksi')->default('not_paid');
            $table->string('bukti_transaksi', 2048)->nullable();
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
        Schema::dropIfExists('transaksis');
    }
}
