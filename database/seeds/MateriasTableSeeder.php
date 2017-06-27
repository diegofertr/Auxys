<?php

use Illuminate\Database\Seeder;
use Auxys\Materia;

class MateriasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::table('materias')->insert([
        	'sigla'=> 'inf-112',
        	'descripcion' => 'Organizacion de computadoras'
        	]);
        DB::table('materias')->insert([
        	'sigla'=> 'inf-121',
        	'descripcion' => 'Algoritmos y Programacion'
        	]);
        DB::table('materias')->insert([
        	'sigla'=> 'inf-142',
        	'descripcion' => 'Fundamentos Digitales'
        	]);
    }
}
