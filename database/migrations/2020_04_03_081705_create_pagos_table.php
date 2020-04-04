<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePagosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pagos', function (Blueprint $table) {
            $table->id();
            $table->string('codigo');
            $table->string('tipo_transaccion');
            $table->date('fecha');
            $table->decimal('cantidad',6,2);
            $table->integer('reses');
            $table->decimal('saldo',6,2);
            $table->string('descripcion')->nullable();
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('codigo')->references('codigo')->on('clientes')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pagos');
    }
}
