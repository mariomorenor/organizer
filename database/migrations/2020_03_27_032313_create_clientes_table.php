<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clientes', function (Blueprint $table) {
            $table->string('codigo')->unique();
            $table->string('nombre')->nullable();
            $table->bigInteger('cedula')->nullable();
            $table->bigInteger('telefono')->nullable();
            $table->string('direccion')->nullable();
            $table->integer('posicion')->default(0);
            $table->integer('mostrar')->default(true);
            $table->softDeletes();
            $table->timestamps();

            $table->primary('codigo');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('clientes');
    }
}
