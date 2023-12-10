<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        $datetime = Carbon::now();

        DB::table('users')->insert([
            'email' => 'admin@imobconnect.com',
            'password' => Hash::make('admin1234'),
            'created_at' => $datetime,
            'updated_at' => $datetime,
        ]);
    }
}
