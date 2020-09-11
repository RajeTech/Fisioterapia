<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGuiasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('guias', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('chave',200)->nullable();
            $table->date('dataAutorizacao')->nullable();
            $table->string('CNES',50)->nullable();
            $table->string('medicoSolicitante',200)->nullable();
            $table->string('tipoAssitencia',200)->nullable();
            $table->string('procedimentoSolicitado1',200)->nullable();
            $table->boolean('inicial1')->nullable();
            $table->integer('competencia1')->nullable();
            $table->integer('qtdRealizado1')->nullable();
            $table->integer('qtdSessoesRealizado1')->nullable();

            $table->string('procedimentoSolicitado2',200)->nullable();
            $table->boolean('inicial2')->nullable();
            $table->integer('competencia2')->nullable();
            $table->integer('qtdRealizado2')->nullable();
            $table->integer('qtdSessoesRealizado2')->nullable();

            $table->string('procedimentoSolicitado3',200)->nullable();
            $table->boolean('inicial3')->nullable();
            $table->integer('competencia3')->nullable();
            $table->integer('qtdRealizado3')->nullable();
            $table->integer('qtdSessoesRealizado3')->nullable();


            $table->text('justificativa')->nullable();
            $table->text('observacoes')->nullable();

            $table->string('nomeSolicitante',200)->nullable();
            $table->boolean('cpfSolicitante')->nullable();
            $table->string('cpfCnsSolicitante',200)->nullable();


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
        Schema::dropIfExists('guias');
    }
}
