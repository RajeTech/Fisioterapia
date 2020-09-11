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
            $table->bigIncrements('id');
            $table->string('nome',200)->nullable();
            $table->string('CPF',20)->nullable();
            $table->string('RG',20)->nullable();
            $table->string('CNS',50)->nullable();
            $table->string('telefone',20)->nullable();
            $table->date('DTnascimento')->nullable();

            $table->string('ruaEndereco',500)->nullable();
            $table->string('bairroEndereco',500)->nullable();
            $table->string('numeroEndereco',10)->nullable();
            $table->string('cidadeEndereco',500)->nullable();

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
        Schema::dropIfExists('clientes');
    }
}
