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
    public function getStudentreport(/*$student_id*/){
        $date= Carbon::now();
        /*$student=Estudiante::find($student_id);
        $materia=$student->estudiante_materia_postulado;*/
        /*dd($materia);*/
        $view = \View::make('postulants.print.report_calification',compact('date'/*,'materia','student'*/))->render();
        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML($view)->setPaper('legal');
        return $pdf->stream();

    } 
    public function print_draw_certificate(){
        /*date= Carbon::now();
        /*$student=Estudiante::find($student_id);
        $materia=$student->estudiante_materia_postulado;*/
        /*dd($materia);*/
        $view = \View::make('postulants.print.draw_theme')->render();
        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML($view)->setPaper('legal');
        return $pdf->stream();
    }
    public function record_certificate_merit(){
        /*date= Carbon::now();
        /*$student=Estudiante::find($student_id);
        $materia=$student->estudiante_materia_postulado;*/
        /*dd($materia);*/
        $view = \View::make('postulants.print.record_competence')->render();
        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML($view)->setPaper('legal');
        return $pdf->stream();
    }

}
