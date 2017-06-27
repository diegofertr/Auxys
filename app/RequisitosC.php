<?php

namespace Auxys;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class RequisitosC extends Model
{
    
	use softDeletes;

	protected $table = 'requisitos_c';

	protected $dates = ['deleted_at'];

	protected $fillalbe = [
           'nombre',
           'descripcion'              
	];
	protected $guarded = ['id'];

	public function convocatorias()
    {
        return $this->belongsToMany('Auxys\Convocatoria','convocatoria_requisito','convocatoria_id','requisitoc_id');
    }
}
