<?php

namespace Auxys\Http\Controllers;

use Illuminate\Http\Request;
use Auxys\convocatoria;

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
        /*->addColumn('affiliate_name', function ($economic_complement) { return $economic_complement->economic_complement_applicant->getTittleName(); })
        ->editColumn('created_at', function ($economic_complement) { return $economic_complement->getCreationDate(); })
        ->editColumn('eco_com_state', function ($economic_complement) { return $economic_complement->economic_complement_state ? $economic_complement->economic_complement_state->economic_complement_state_type->name . " " . $economic_complement->economic_complement_state->name : $economic_complement->wf_state->name; })
        ->editColumn('eco_com_modality', function ($economic_complement) { return $economic_complement->economic_complement_modality->economic_complement_type->name . " " . $economic_complement->economic_complement_modality->name; })
        ->addColumn('action', function ($economic_complement) { return
            '<div class="btn-group" style="margin:-3px 0;">
            <a href="economic_complement/'.$economic_complement->id.'" class="btn btn-primary btn-raised btn-sm">&nbsp;&nbsp;<i class="glyphicon glyphicon-eye-open"></i>&nbsp;&nbsp;</a>
            <a href="" class="btn btn-primary btn-raised btn-sm dropdown-toggle" data-toggle="dropdown">&nbsp;<span class="caret"></span>&nbsp;</a>
            <ul class="dropdown-menu">
                <li><a href="voucher/delete/ '.$economic_complement->id.' " style="padding:3px 10px;"><i class="glyphicon glyphicon-ban-circle"></i> Anular</a></li>
            </ul>
            </div>';})*/
        ->make(true);

    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
}
