<?php

namespace Auxys;

use Illuminate\Database\Eloquent\Model;
use Auxys\Materia;
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
		return $this->belongsTomany(Materia::class);
	}

	public function requisitosC(){
      return $this->belongsToMany('Auxys\RequisitosConvocatoria','documentos_entregados','estudiante_id','requisitoc_id');
   }
}
