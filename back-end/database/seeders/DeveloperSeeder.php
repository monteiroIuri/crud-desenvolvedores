<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DeveloperSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('developer')->insert([
            [
                'nome' => 'Luiz',
                'sexo' => 'M',
                'idade' => 28,
                'hobby' => 'Jogos online',
                'datanascimento' => '1993-08-10'
            ],
            [
                'nome' => 'Rafael',
                'sexo' => 'M',
                'idade' => 25,
                'hobby' => 'Leitura',
                'datanascimento' => '1997-03-07'
            ],
            [
                'nome' => 'Ana',
                'sexo' => 'F',
                'idade' => 25,
                'hobby' => 'Viajar',
                'datanascimento' => '1997-09-25'
            ],
            [
                'nome' => 'Joana',
                'sexo' => 'F',
                'idade' => 19,
                'hobby' => 'Natação',
                'datanascimento' => '2002-03-01'
            ],
            [
                'nome' => 'Gabriel',
                'sexo' => 'M',
                'idade' => 38,
                'hobby' => 'Futebol',
                'datanascimento' => '1983-09-23'
            ],
            [
                'nome' => 'Felipe',
                'sexo' => 'M',
                'idade' => 21,
                'hobby' => 'Assistir séries',
                'datanascimento' => '2000-12-10'
            ],
            [
                'nome' => 'Leticia',
                'sexo' => 'F',
                'idade' => 27,
                'hobby' => 'Viajar',
                'datanascimento' => '1994-07-05'
            ],
            [
                'nome' => 'Pedro',
                'sexo' => 'M',
                'idade' => 41,
                'hobby' => 'Boliche',
                'datanascimento' => '1980-08-11'
            ],
            [
                'nome' => 'Marcio',
                'sexo' => 'M',
                'idade' => 31,
                'hobby' => 'Cozinhar',
                'datanascimento' => '1990-07-17'
            ],
            [
                'nome' => 'Rafaela',
                'sexo' => 'F',
                'idade' => 25,
                'hobby' => 'Leitura',
                'datanascimento' => '1997-09-02'
            ]
        ]);
    }
}
