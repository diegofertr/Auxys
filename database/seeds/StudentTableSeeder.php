<?php

use Illuminate\Database\Seeder;
use Auxys\Student;

class StudentTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Student::class, 20)->create();
    }
}
