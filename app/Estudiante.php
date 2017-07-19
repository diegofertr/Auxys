<?php

namespace Auxys;

use Illuminate\Database\Eloquent\Model;
use Auxys\Materia;
use Auxys\Semestre;
class Estudiante extends Model
{
    //use softDeletes;

	protected $table = 'estudiantes';

	protected $dates = ['deleted_at'];

	protected $fillable = [

          	'carnet_identidad',
            'nombre',
            'paterno',
            'materno',
            'materias'
	];

	protected $guarded = ['id'];

	public function materias_postula(){
		return $this->belongsToMany('Auxys\Materia', 'estudiante_postula_materia','estudiante_id','materia_id');
	}
	public function materias()
	{
		return $this->belongsTomany(Materia::class)->withPivot('nota', 'periodo');
	}
  public function materiasSemestre($semestre_id)
  {
    return $this->materias()->where('semestre_id','=',$semestre_id)->get();
  }
	public function requisitosC(){
      return $this->belongsToMany('Auxys\RequisitosConvocatoria','documentos_entregados','estudiante_id','requisitoc_id');
  	}
  	public function aproboMateria($materia_id){	
  		$status=$this->materias()->where('id','=',$materia_id)->where('nota','>',50)->first();		
  		if ($status) {
  			return true;
   		}
   		return false;
   	}
   	public function aproboSemestre($semestre_id)
   	{
   		$materias_semetre=Semestre::find($semestre_id);
   		foreach ($materias_semetre->materias as $materia) {
   			$status=$this->aproboMateria($materia->id);
   			if (!$status) {
   				return false;
   			}
   		}
   		return true;
   	}
   	public function aproboHastaSemestre($semestre_id)
   	{
   		for ($i=1; $i <=$semestre_id ; $i++) { 
   			$status = $this->aproboSemestre($i);
   			if (!$status) {
   				return false;
   			}
   		}
   		return true;
   	}
   	public function aproboPrerequisitos($materia_id)
   	{
   		$materia = Materia::find($materia_id);
   		foreach ($materia->requisitosMateria as $materia_pre) {
   			$status = $this->aproboMateria($materia_pre->id);
   			if (!$status) {
   				return false;
   			}
   		}
   		return true;
   	}
    public function getFullName()
    {
      return $this->paterno.' '.$this->materno.' '.$this->nombre;
    }
}
