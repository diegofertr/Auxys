<?php

use Illuminate\Database\Seeder;

class SemestresTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$nombres=["","1er semestre","2do semestre","3er semestre","4to semestre","5to semestre","6to semestre","7mo semestre","8vo semestre","9no semestre","10mo semestre","Optativas"];
    	for ($i=1; $i <count($nombres) ; $i++) { 
    		Auxys\Semestre::create([
	            'nombre' => $nombres[$i]
	        ]);
    	}
    }
}
