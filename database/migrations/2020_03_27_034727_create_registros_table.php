<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRegistrosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('registros', function (Blueprint $table) {
            
            $table->string('cliente_codigo');
            $table->integer('cantidad');
            $table->date('fecha');
            $table->string('descripcion')->nullable();
            $table->softDeletes();
            $table->timestamps();
            $table->primary(['cliente_codigo','fecha']);
          
            
            $table->foreign('cliente_codigo')->references('codigo')->on('clientes')->onDelete('cascade');;
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('registros');
    }
}
