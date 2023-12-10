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
        Schema::create('detalheimovel', function (Blueprint $table) {
            $table->id();
            $table->boolean('ismobiliado');
            $table->boolean('issemimobiliado');
            $table->integer('numerobanheiros');
            $table->integer('numeroquartos');
            $table->double('metrosquadrados', 14,2);
            $table->string('descricao', 600);
            $table->boolean('haselevador');
            $table->boolean('hasinternet');
            $table->boolean('hassalaodefestas');
            $table->boolean('hassacada');
            $table->boolean('haslavanderia');
            $table->boolean('hasarcondicionado');
            $table->boolean('hasareadelazer');
            $table->boolean('hasestacionamento');
            $table->integer('numerodevagas');
            $table->boolean('isanimaispermitidos');
            $table->string('tipodepiso', 150);
            $table->boolean('hasportaria');
            $table->string('observacoes', 1000);
            $table->boolean('ativo');
            $table->boolean('haschurrasqueira');
            $table->boolean('haspiscina');
            $table->boolean('hasquiosque');
            $table->boolean('iscercado');
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
        Schema::dropIfExists('detalheimovel');
    }
};
