<?php

namespace Auxys\Http\Controllers\Student;

use Illuminate\Http\Request;
use Auxys\Http\Controllers\Controller;
use Excel;
use Auxys\Estudiante;
use Auxys\Materia;
use Auxys\Semestre;
use Yajra\Datatables\Datatables;


class StudentController extends Controller
{
    public function check(Request $request)
    {
        $student_ci=$request->cedula_identidad;
        $student=Estudiante::where('carnet_identidad','like',$request->cedula_identidad)->first();
        $results=array();
        foreach ($request->materias as $materia_id) {
            $materia=Materia::find($materia_id);
            $aprobo_materia=$student->aproboMateria($materia_id);
            $aprobo_semestre=$student->aproboHastaSemestre($materia->semestre_id);
            $aprobo_prerequisitos=$student->aproboPrerequisitos($materia_id);
            if ($aprobo_materia && $aprobo_semestre && $aprobo_prerequisitos) {
                $temp=array('materia_id'=>$materia_id,'sigla'=>$materia->sigla,'descripcion'=>$materia->descripcion,'icon'=>'check','status'=>'success','color'=>'#3C763D');
            }else{
                $temp=array('materia_id'=>$materia->id,'sigla'=>$materia->sigla,'descripcion'=>$materia->descripcion,'icon'=>'close','status'=>'danger','color'=>'#A94442');
            }
            if ($aprobo_semestre) {
                $temp=array_merge($temp,array('semestre_status'=>'success','semestre_icon'=>'check','semestre_color'=>'#3C763D'));
            }else{
                $temp=array_merge($temp,array('semestre_status'=>'danger','semestre_icon'=>'close','semestre_color'=>'#A94442'));
            }
            if ($aprobo_prerequisitos) {
                $temp=array_merge($temp,array('prerequisitos_status'=>'success','prerequisitos_icon'=>'check','prerequisitos_color'=>'#3C763D'));
            }else{
                $temp=array_merge($temp,array('prerequisitos_status'=>'danger','prerequisitos_icon'=>'close','prerequisitos_color'=>'#A94442'));
            }
            if ($aprobo_materia) {
                $temp=array_merge($temp,array('materia_status'=>'success','materia_icon'=>'check','materia_color'=>'#3C763D'));
            }else{
                $temp=array_merge($temp,array('materia_status'=>'danger','materia_icon'=>'close','materia_color'=>'#A94442'));
            }

            $temp=array_merge($temp,array('student_id'=>$student->id));

            
            $results[]=$temp;
        }
        return response()->json($results);
    }
    public function getStudentInfo(Request $request)
    {
        $student=Estudiante::where('carnet_identidad','=',$request->cedula_identidad)->first();
        if ($student) {
            return response()->json($student);
        }
        return response()->json('error');
    }
    public function postulate(Request $request)
    {
        $student=Estudiante::find($request->student_id_postulate);
        $materia_id=$request->materia_id_postulate;
        $student->materias_postula()->attach($materia_id,['nota_examen_escrito' =>0,'nota_meritos' =>0,'nota_examen_oral'=>0, 'total'=>0,'designado'=>0,'categoria'=>'']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function importStudents(Request $request)
    {
        if ($request->hasFile('file')) {
            $file = $request->file->getRealPath();
            // $file = time().'.'.$request->file->getClientOriginalExtension();
            // $request->file->move(public_path('students'), $file);
            $data = Excel::load($file, function($reader) {
                    },'UTF-8')->get();
            if(!empty($data) && $data->count()){
                $count=0;
                foreach ($data as $student) {
                    $count++;
                    $new_student=new Estudiante();
                    $new_student->paterno=$student->last_name??'';
                    $new_student->materno=$student->sure_name??'';
                    $new_student->nombre=$student->first_name;
                    $new_student->carnet_identidad=strval($student->document_id);
                    $old_student=$this->save(new Request , $new_student);
                    $materia_id=$this->exists($student->codigo);
                    if($old_student->materias()->where('id','=',$materia_id)->first()){
                       $old_student->materias()->updateExistingPivot($materia_id,['nota' => $student->nota,'periodo' => $student->codperiodo]);
                    }else{
                       $old_student->materias()->attach($materia_id,['nota' => $student->nota,'periodo' => $student->codperiodo]);
                    }
                }
            }
            //dd($data[0]);
            /*if(!empty($data) && $data->count()){
                $count=0;
                foreach ($data as $student) {
                    $count++;
                    // $string=$student->last_namesure_namefirst_namedocument_idcodigonombrenotaperiodo;
                    $string=$student->last_namesure_namefirst_namedocument_idcodigonotacodperiodoperiodo;
                        ;
                    $attributes = explode(";", $string);
                    $new_student=new Estudiante();
                    $new_student->paterno=$attributes[0];
                    $new_student->materno=$attributes[1];
                    $new_student->nombre=$attributes[2];
                    $new_student->carnet_identidad=$attributes[3];
                    $old_student=$this->save(new Request , $new_student);
                    $materia_id=$this->exists($attributes[4]);
                    if($old_student->materias()->where('id','=',$materia_id)->first()){
                       $old_student->materias()->updateExistingPivot($materia_id,['nota' => $attributes[5],'periodo' => $attributes[7]]);
                    }else{
                       $old_student->materias()->attach($materia_id,['nota' => $attributes[5],'periodo' => $attributes[7]]);
                    }
                }
            }*/
            // dd($data);
            return back();
        }
    }
    public function exists($sigla)
    {
      $old_materia=Materia::where('sigla','=',$sigla)->first();
      if ($old_materia) {
        return $old_materia->id;
      }
      return 0;
    }
    public function save(Request $request, Estudiante $student )
    {
        $old_student=Estudiante::where('carnet_identidad','=',$student->carnet_identidad)->first();
        if (!$old_student) {
            $student->save();
            return $student;
        }
            return $old_student;
    }
    public function import()
    {
        return view('students.import');
    }
    public function index()
    {
        return view('students.index');
    }
    public function getStudents()
    {
      $students=Estudiante::select('carnet_identidad', 'nombre','paterno','materno','id');
      return Datatables::of($students)
      ->addColumn('action', function ($student)
      {
        return 
        '<div class="btn-group">
        <a href="'.url('student', $student).'" role="button" class="btn bg-olive"><i class="fa fa-eye"></i></a>
        <button type="button" class="btn bg-olive dropdown-toggle" data-toggle="dropdown">
          <span class="caret"></span>
          <span class="sr-only">Toggle Dropdown</span>
        </button>
        <ul class="dropdown-menu" role="menu">
          <li><a href="#"><i class="fa fa-pencil"></i>Editar</a></li>
          <li><a href="#"><i class="fa fa-minus"></i>Eliminar</a></li>
        </ul>
      </div>';
    })
      ->make(true);
    }

    public function materiaStudent(Request $request) {
      $student=Estudiante::find($request->id);
      $materias=$student->materias()->select('id','sigla','descripcion')->get();
      return Datatables::of($materias)
      ->editColumn('action', function ($materia){
        return '<span class="badge bg-green" style="font-size:1.2em">'.$materia->pivot->nota.'</span>';
      })
      ->editColumn('observacion', function($materia) {
        return  'Aprobado  '.$materia->pivot->periodo.'';
      })
      ->make(true);
    }

    public function cumpleRequisito(Request $request){
        $estudiante = Estudiante::find($request->estudiante_id);
        $materia = Materia::find($request->materia);
        $cumple = false;
        // $requisitos = $materia->requisitosMateria()->get();
        $requisitos_materia = Materia::find($request->materia)->requisitosMateria()->select('materia_req_id')->get();
        $aproveds=$estudiante->materias;
        foreach ($aproveds as $aproved) {
            foreach ($requisitos_materia as $requisito) {
                if ($aproved->id == $requisito->materia_req_id) {
                    $cumple = true;
                }
            }
        }
        if ($cumple) {
            return view('students.cumple', compact('estudiante'));
        } else {
            return back();
        }
    }

    public function postulants()
    {
      $materias=Materia::all();
      return view('postulants.index',compact('materias'));
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
        $student=Estudiante::find($id);
        $materias = Materia::all();
        $semestres = Semestre::all();
        $materias_list = array('' => '');
        foreach ($materias as $item) {
            $materias_list[$item->id] = $item->sigla;
        }
        // $materias=$student->materias;
        // return view('students.show',compact('student','materias'));   
        return view('students.show',compact('student','materias_list','semestres'));   
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
