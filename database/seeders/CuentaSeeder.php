<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CuentaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('cuentas')->insert([
            'nroCuenta' => Str::random(10),
            'saldo' => 0
        ]);

        DB::table('cuentas')->insert([
            'nroCuenta' => Str::random(10),
            'saldo' => 0
        ]);

        DB::table('cuentas')->insert([
            'nroCuenta' => Str::random(10),
            'saldo' => 0
        ]);

        DB::table('cuentas')->insert([
            'nroCuenta' => Str::random(10),
            'saldo' => 0
        ]);

        DB::table('cuentas')->insert([
            'nroCuenta' => Str::random(10),
            'saldo' => 0
        ]);
    }
}
