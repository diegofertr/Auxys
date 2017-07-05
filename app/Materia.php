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
            'descripcion'              
	];
	protected $guarded = ['id'];

	public function convocatorias()
    {
        return $this->belongsToMany('Auxys\Convocatoria','convocatoria_materia','convocatoria_id','materia_id');
    }

   	public function requisitosMateria(){
		return $this->belongsToMany('Auxys\Materia', 'requisitos_m','materia_id','materia_req_id');
   	}
   	public function estudiantes()
   	{
   		return $this->belongsToMany(Estudiante::class);
   	}
}
