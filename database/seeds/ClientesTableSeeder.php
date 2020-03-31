<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ClientesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('clientes')->insert([
            'codigo'=>'95',
            'posicion'=>1
        ]);
        DB::table('clientes')->insert([
            'codigo'=>'87',
            'posicion'=>2
        ]);
        DB::table('clientes')->insert([
            'codigo'=>'75',
            'posicion'=>3
        ]);
        DB::table('clientes')->insert([
            'codigo'=>'90',
            'posicion'=>4
        ]);
        DB::table('clientes')->insert([
            'codigo'=>'01',
            'posicion'=>5
        ]);
        DB::table('clientes')->insert([
            'codigo'=>'MTI',
            'posicion'=>6
        ]);
    }
}
