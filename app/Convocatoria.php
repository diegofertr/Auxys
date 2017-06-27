<?php

namespace Auxys;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Convocatoria extends Model
{
 
	use softDeletes;

	protected $table = 'convocatorias';

	protected $dates = ['deleted_at'];

	protected $fillable = [
         'gestion',
         'semestre',
         'modalidad',
         'desde',
         'hasta',
         'fecha_de_publicacion',
         'description', 
         'decano', 
         'vice_decano', 
         'director'
	];

	protected $guarded = ['id'];

	public function materias(){
		return $this->belongsToMany('Auxys\Materia', 'convocatoria_materia','convocatoria_id','materia_id');
	}

   public function requisitosC(){
      return $this->belongsToMany('Auxys\RequisitosC','convocatoria_requisito','convocatoria_id','requisitoc_id');
   }

}
