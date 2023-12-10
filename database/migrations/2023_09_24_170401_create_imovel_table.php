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
        Schema::create('imovel', function (Blueprint $table) {
            $table->id();
            $table->string('titulo');
            $table->foreignId('iddetalheimovel');
            $table->foreignId('idtipoimovel');
            $table->foreignId('idendereco');
            $table->boolean('islocation');
            $table->boolean('isvenda');
            $table->decimal('valoraluguel', 14,2)->nullable();
            $table->decimal('valorvenda', 14,2)->nullable();
            $table->boolean('ativo');
            $table->foreignId('idpessoa');
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
        Schema::dropIfExists('imovel');
    }
};
