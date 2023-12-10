<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pessoa', function (Blueprint $table) {
            $table->id();
            $table->string('nome',200);
            $table->string('cpf',11);
            $table->string('cnpj',14);
            $table->date('datanascimento');
            $table->string('telefone',11);
            $table->string('razaosocial',200);
            $table->string('nomefantasia',200);
            $table->boolean('isproprietario')->default(false);
            $table->boolean('ativo')->default(true);
            $table->foreignId('idendereco');
            $table->timestamps();
        });
    }


    /**
     * Reverse the migrations.
     *
     * 
     * 
    
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pessoa');
    }
};
