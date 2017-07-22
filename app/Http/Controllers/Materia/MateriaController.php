<?php

namespace Auxys\Http\Controllers\Materia;

use Illuminate\Http\Request;
use Auxys\Http\Controllers\Controller;

use Auxys\Materia;
use Datatables;
use DB;
use Excel;
use Auxys\Estudiante;
use Auxys\Semestre;


class MateriaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        $materias = Materia::all();
        $materias_list = array('' => '');
        foreach ($materias as $item) {
            $materias_list[$item->id] = $item->sigla;
        }
        $sems = Semestre::all();
        $semestres = ['' => ''];
        foreach ($sems as $s) {
          $semestres[$s->id] = $s->nombre;
        }
        return view('materias.index', compact('materias_list','semestres'));
    }

    public function getMaterias(Request $request) {
        $materias = Materia::select(['id', 'sigla', 'descripcion'])->get();
        return Datatables::of($materias)
        ->addColumn('action', function ($materia) { return
            '<div class="btn-group">
              <button type="button" class="btn bg-olive dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Acciones <span class="caret"></span>
              </button>
              <ul class="dropdown-menu">
                <li class="dropdown-header">Prerequisitos - opciones</li>
                <li>
                  <button type="button" class="btn bg-navy btn-sm" data-toggle="modal" data-target="#prerequisiteModal" data-sigla="'.$materia->sigla.'" data-id="'.$materia->id.'">
                    <span>
                      <i class="fa fa-plus"></i> Añadir Prerequisito
                    </span>
                  </button>
                </li>
                <li>
                  <button type="button" class="btn bg-purple btn-sm" data-toggle="modal" data-target="#editprerequisiteModal" data-id="'.$materia->id.'">
                    <span>
                      <i class="fa fa-pencil"></i> Editar Prerequisitos
                    </span>
                  </button>
                </li>

                <li class="dropdown-header">Materia - opciones</li>
                <li><button type="button" class="btn bg-orange btn-sm" data-toggle="modal" data-target="#editmateriaModal" data-id="'.$materia->id.'" data-sigla="'.$materia->sigla.'" data-descripcion="'.$materia->descripcion.'" data-semestre_id="'.$materia->semestre_id.'">
                      <span>
                        <i class="fa fa-pencil"></i> Editar Materia
                      </span>
                    </button>
                </li>
                <li><a href="/materias/delete_materia/' .$materia->id. '" class="btn bg-maroon btn-sm">
                        <span>
                            <i class="fa fa-minus"></i> Eliminar Materia
                        </span>
                    </a>
                </li>
              </ul>
            </div>
            ';})
        ->editColumn('prerequisites', function($materia) {
            $requisitos_materia = $materia->requisitosMateria;
            $valor = ' ';
            foreach ($requisitos_materia as $item){
                $valor.=$item->sigla.', ';
            }
            $valor = substr($valor,0,-2).'.';
            if ($valor == '.' || $valor == '') {
              return 'No tiene prerequisitos.';
            } else {
              return $valor;
            }
          // return 'BALUBALUBALU.';
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
        $sems = Semestre::all();
        $semestres = ['' => ''];
        foreach ($sems as $s) {
          $semestres[$s->id] = $s->nombre;
        }
        return view('materias.create', compact('semestres'));
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
        $materia->semestre_id = $request->semester_id;
        $materia->save();

        // return redirect()->route('materias.index');
        return back();
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
        // $materia = Materia::find($id);
        // // $requisitos_materia = Materia::find($id)->requisitosMateria()->get();
        // // // dd($requisitos_materia[0]->sigla);
        // // $requisitos_list = array('' => '');
        // // foreach ($requisitos_materia as $item) {
        // //     $requisitos_list[$item->id] = $item->sigla;
        // // }
        // $materias = Materia::all();
        // $materias_list = array('' => '');
        // foreach ($materias as $item) {
        //     $materias_list[$item->id] = $item->sigla;
        // }
        // return view('materias.show', compact('materia','materias_list'));
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
        $materia = Materia::find($id);
        $materia->sigla = $request->sigla;
        $materia->descripcion = $request->descripcion;
        $materia->semestre_id = $request->semester_id;
        $materia->save();
        
        return back();
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
