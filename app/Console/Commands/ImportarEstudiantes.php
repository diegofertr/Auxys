<?php

namespace Auxys\Console\Commands;

use Illuminate\Console\Command;
use Auxys\Estudiante;
use Auxys\Materia;
use Excel;
class ImportarEstudiantes extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:estudiantes';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Importacion de los estudiantes';

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
            $path = $this->choice('Ingrese la ruta del archivo: ', ['zechus_completo_excel.xlsx']);
            $this->info('Importando...');
            Excel::load('/public/import/'.$path, function($reader) {
                global $results;
                $results = collect($reader->get());
            },'UTF-8');
            $bar = $this->output->createProgressBar(count($results));
            foreach ($results as $student) {
                $row_student=Estudiante::where('carnet_identidad','=',$student->document_id)->first();
                if (!$row_student) {
                    $new_student=new Estudiante();
                    $new_student->paterno=$student->last_name??'';
                    $new_student->materno=$student->sure_name??'';
                    $new_student->nombre=$student->first_name;
                    $new_student->carnet_identidad=strval($student->document_id);
                    $new_student->save();
                    $row_student=$new_student;
                }
                $materia=Materia::where('sigla','=',$student->codigo)->first();
                if (isset($materia)) {
                    if($row_student->materias()->where('id','=',$materia->id)->first()){
                       $row_student->materias()->updateExistingPivot($materia->id,['nota' => $student->nota,'periodo' => $student->codperiodo]);
                    }else{
                       $row_student->materias()->attach($materia->id,['nota' => $student->nota,'periodo' => $student->codperiodo]);
                    }
                }else{
                    dd("__- -__");
                }
                $bar->advance();
            }
            $this->info("\n\nTerminado.");
        }
    }
}
