<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProntuariosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('prontuarios', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('chave',200)->nullable();
            $table->string('cid',50)->nullable();
            $table->text('quadroClinico')->nullable();
            $table->text('avaliacao')->nullable();
            $table->text('observacoes')->nullable();

            $table->integer('cliente-id')->unsigned();
           // $table->foreign('cliente-id')->references('id')->on('clientes');
            
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
        Schema::dropIfExists('prontuarios');
    }
}
