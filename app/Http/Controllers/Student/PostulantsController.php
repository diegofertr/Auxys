<?php

namespace Auxys\Http\Controllers\Student;

use Illuminate\Http\Request;
use Auxys\Http\Controllers\Controller;
use Auxys\Estudiante;
use Auxys\Materia;
use Carbon\Carbon;
class PostulantsController extends Controller
{
    public function printPostulants($materia_id)
    {
    	$date=Carbon::now();
    	$materia=Materia::find($materia_id);
    	$students=$materia->estudiantes_postulados;
    	$view = \View::make('postulants.print.list_postulants',compact('students', 'materia','date'))->render();
    	$pdf = \App::make('dompdf.wrapper');
    	$pdf->loadHTML($view)->setPaper('legal','landscape');
    	return $pdf->stream();
    }
}
