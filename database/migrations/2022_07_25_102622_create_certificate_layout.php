<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCertificateLayout extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('certificate_layouts', function (Blueprint $table) {
            $table->id();

            $table->string('uuid', 32)->unique();
            $table->string('certificate_path', 2048)->nullable();
            $table->foreignId('id_event');
            $table->integer('x');
            $table->integer('y');
            $table->string('font');
            $table->integer('fontSize');
            $table->string('color');
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
        Schema::dropIfExists('certificate_layouts');
    }
}
