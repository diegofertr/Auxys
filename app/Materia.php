<?php

namespace Auxys;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Materia extends Model
{
    
	use softDeletes;

	protected $table = 'materias';

	protected $dates = ['deleted_at'];

	protected $fillalbe = [
    'sigla',
    'descripcion',              
    'semestre_id'              
	];
	protected $guarded = ['id'];

	public function convocatorias()
    {
        return $this->belongsToMany('Auxys\Convocatoria','convocatoria_materia','convocatoria_id','materia_id');
    }

   	public function requisitosMateria(){
		return $this->belongsToMany('Auxys\Materia', 'requisitos_m','materia_id','materia_req_id');
   	}
    public function estudiantes_postulados(){
      return $this->belongsToMany('Auxys\Estudiante', 'estudiante_postula_materia','materia_id');
    }
    
   	public function estudiantes()
   	{
   		return $this->belongsToMany(Estudiante::class)->withPivot('nota', 'periodo');
   	}
    public static function exists(Materia $materia)
    {
      $old_materia=Materia::where('sigla','=',$materia->sigla)->first();
      if (!$old_materia) {
        $materia->save();
      }
    }
    public function semestre()
    {
      return $this->belongsTo(Semestre::class);
    }
}
