<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DetalheImovelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('detalheimovel')->insert([
            'ismobiliado' => true,
            'issemimobiliado' => false,
            'numerobanheiros' => 2,
            'numeroquartos' => 3,
            'metrosquadrados' => 94,
            'descricao' => 'Imóvel aconchegante para a família',
            'haselevador' => false,
            'hasinternet' => false,
            'hassalaodefestas' => false,
            'hassacada' => false,
            'haslavanderia' => true,
            'hasarcondicionado' => true,
            'hasareadelazer' => true,
            'hasestacionamento' => true,
            'numerodevagas' => 2,
            'isanimaispermitidos' => true,
            'tipodepiso' => 'piso tal',
            'hasportaria' => false,
            'observacoes' => 'Observações',
            'ativo' => true,
            'haschurrasqueira' => true,
            'haspiscina' => true,
            'hasquiosque' => true,
            'iscercado' => true
        ]);
    }
}
