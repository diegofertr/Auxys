<?php

namespace Auxys\Console\Commands;

use Illuminate\Console\Command;
use Excel;
use Auxys\Materia;
class ImportarMaterias extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:materias';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Importtacion de las Materias';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        global $results;
        $password = $this->secret('Ingrese la contrasenia');
        if ($password == 'eycy') {
            $path = $this->choice('Ingrese la ruta del archivo: ', ['zechus_materias.csv']);
            $this->info('Importando...');
            Excel::load('/public/import/'.$path, function($reader) {
                global $results;
                $results = collect($reader->get());
            });
            $bar = $this->output->createProgressBar(count($results));
            foreach ($results as $materia) {
                $string=$materia->codigonombrenivelnombre;
                //$string=$materia->id_plan_estudiocodigonombre;
                $attributes = explode(";", $string);
                $m=new Materia();
                $m->sigla=$attributes[0];
                $m->descripcion=$attributes[1];
                $m->semestre_id=$attributes[2];
                Materia::exists($m);
                $bar->advance();
            }
            $this->info('Terminado.');
        }
    }
}
