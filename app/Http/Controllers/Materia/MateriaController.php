<?php

namespace Auxys\Http\Controllers\Materia;

use Illuminate\Http\Request;
use Auxys\Http\Controllers\Controller;

use Auxys\Materia;
use Yajra\Datatables\Datatables;

class MateriaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('materias.index');
    }

    public function getMaterias(Request $request) {
        $materias = Materia::select(['id', 'sigla', 'descripcion'])->get();
        return Datatables::of($materias)
        ->addColumn('action', function ($materia) { return
            '<div class="btn-group">
              <a href="/materias/'. $materia->id.'" class="btn btn-warning">Editar</a>
              <button type="button" class="btn btn-warning dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="caret"></span>
                <span class="sr-only">Toggle Dropdown</span>
              </button>
              <ul class="dropdown-menu">
                <li><a href="/materias/deleteM/' .$materia->id. '" ><i class="glyphicon glyphicon-minus"></i>Eliminar</a></li>
              </ul>
            </div>';})
        ->make(true);        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('materias.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $materia = new Materia();
        $materia->sigla = $request->sigla;
        $materia->descripcion = $request->descripcion;
        $materia->save();
        return redirect()->route('materias.index');
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
        $materia = Materia::find($id);
        // $requisitos=Materia::find($id)->requisitosMateria()->get();
        // $requisitos_materia = Materia::find($id)->requisitosMateria()->select('materia_id','materia_req_id')->get();
        // dd($requisitos_materia);
        // $requisitos_materia_list = ['' => ''];
        // foreach ($requisitos_materia as $item) {
        //     $requisitos_materia_list[$item->id] = $item->materia_id;
        //     // $requisitos_materia_list[$item->id] = $item->materia_req_id;
        // }
        return view('materias.show', compact('materia'));
    }

    public function materiaPrerequisitos(Request $request) {
        $requisitos_materia = Materia::find($request->id)->requisitosMateria()->select('materia_id','materia_req_id')->get();
        return Datatables::of($requisitos_materia)
        ->make(true);
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

    public function deleteM($id){
        $materia = Materia::find($id);
        $materia->delete();
        return back();
    }
}
