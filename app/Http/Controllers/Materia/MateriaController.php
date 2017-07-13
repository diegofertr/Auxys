<?php

namespace Auxys\Http\Controllers\Materia;

use Illuminate\Http\Request;
use Auxys\Http\Controllers\Controller;

use Auxys\Materia;
use Yajra\Datatables\Datatables;
use DB;
use Excel;
use Auxys\Estudiante;

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
              <a href="/materias/'. $materia->id.'" class="btn bg-olive circle">
                <i class="fa fa-eye"></i>
              </a>
              <button type="button" class="btn bg-olive circle dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="caret"></span>
                <span class="sr-only">Toggle Dropdown</span>
              </button>
              <ul class="dropdown-menu">
                <li><a href="/materias/delete_materia/' .$materia->id. '" >
                        <span style="color:red;">
                            <i class="fa fa-minus"></i> Eliminar
                        </span>
                    </a>
                </li>
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
        // $requisitos_materia = Materia::find($id)->requisitosMateria()->get();
        // // dd($requisitos_materia[0]->sigla);
        // $requisitos_list = array('' => '');
        // foreach ($requisitos_materia as $item) {
        //     $requisitos_list[$item->id] = $item->sigla;
        // }
        $materias = Materia::all();
        $materias_list = array('' => '');
        foreach ($materias as $item) {
            $materias_list[$item->id] = $item->sigla;
        }
        return view('materias.show', compact('materia','materias_list'));
    }

    public function addPrerequisite(Request $request){
        $materia = Materia::find($request->materia_id);
        // dd($request);
        foreach ($request->requisites as $requisite) {
            $materia->requisitosMateria()->attach($requisite);
        }
        // $materia->requisitosMateria()->attach($request->materia_req_id);
        return back();
    }

    public function deletePrerequisite($id,$materia_id) {
        // $materia = Materia::find($idM);
        // dd($data);
        // $user->roles()->detach($roleId);
        // dd($id,$materia_id);
        $materia = Materia::find($materia_id);
        $materia->requisitosMateria()->detach($id);
        return back();
    }

    public function materiaPrerequisitos(Request $request) {
        $requisitos_materia = Materia::find($request->id)->requisitosMateria()->select('materia_id','materia_req_id')->get();
        return Datatables::of($requisitos_materia)
        ->editColumn('materia_req_sigla', function ($materia){
            $mate = Materia::find($materia->materia_req_id);
            return $mate->sigla;
        })
        ->editColumn('materia_req_desc', function ($materia){
            $mate = Materia::find($materia->materia_req_id);
            return $mate->descripcion;
        })
        ->addColumn('action', function($materia) {
            return '
            <a href="/delete_prerequisite_m/'.$materia->materia_req_id.'/'.$materia->materia_id.'" class="btn bg-olive" data-toggle="tooltip" data-placement="top" title="Eliminar Prerequisito">
                <i class="fa fa-minus"></i>
            </a>';
        })
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

    public function deleteMateria($id){
        $materia = Materia::find($id);
        $materia->delete();
        return back();
    }
    public function getListMaterias(Request $request)
    {
        $term = trim($request->term);
        if (empty($term)) {
            return response()->json([]);
        }
        $materias = Materia::where('sigla','like','%'.$term.'%')->get();
        $formatted_materias = [];
        foreach ($materias as $materia) {
            $formatted_materias[] = ['id' => $materia->id, 'text' => $materia->sigla];
        }
        return response()->json($formatted_materias);
    }
}
