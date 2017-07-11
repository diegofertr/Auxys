<?php

namespace Auxys\Http\Controllers\Convocatoria;

use Illuminate\Http\Request;
use Auxys\Http\Controllers\Controller;
use Auxys\convocatoria;
use Auxys\Materia;
use Auxys\RequisitosConvocatoria;
use PDF;
use Carbon\Carbon;

class ConvocatoriaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('convocatoria.index');
    }

    public function dataTables(){

        $convocatorias = Convocatoria::All();
        dd($convocatorias);
        return Datatables::of($convocatorias)
        ->addColumn('gestion', function ($convocatorias) {
            return "hola primer campo";
        })
        ->make(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('convocatoria.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function print_announcement()
    {   
        setlocale(LC_ALL, "es_ES.UTF-8");
        $current_date=strftime("%e de %B de %Y",strtotime(Carbon::now()));
        $number_announcement=3;
        $year=Carbon::now()->year;
        $period=2;
        $semester='Segundo';
        $deadline_date=strftime("%e del mes de %B de %Y",strtotime(Carbon::now()->addWeeks(3)));
        $deadline_time=Carbon::now()->toTimeString();
        $requisitos = RequisitosConvocatoria::all();
        $materias=Materia::all();
        $view =  \View::make('convocatoria.print_convocatoria', compact('materias', 'current_date', 'number_announcement','year','period','semester','deadline_date','deadline_time', 'requisitos'))->render();
        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML($view);
        return $pdf->stream('invoice');
    }
}
