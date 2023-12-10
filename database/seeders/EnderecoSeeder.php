<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EnderecoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('endereco')->insert([
            'idcidade' => 1,
            'cep' => '95900704',
            'rua' => 'Rua tal',
            'bairro' => 'Bairro tal',
            'numero' => 001,
            'complemento' => true,
            'ativo' => true
        ]);
    }
}
