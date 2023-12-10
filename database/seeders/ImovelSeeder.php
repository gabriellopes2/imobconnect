<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class ImovelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('imovel')->insert([
            'titulo' => 'Casa de 3 quartos, linda e aconchegante para sua família.',
            'iddetalheimovel' => 1,
            'idtipoimovel' => 2,
            'idendereco' => 1,
            'islocation' => false,
            'isvenda' => true,
            'valoraluguel' => 100,
            'valorvenda' => 100,
            'ativo' => true,
            'idpessoa' => 1
        ]);
    }
}
