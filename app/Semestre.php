<?php

namespace Auxys;

use Illuminate\Database\Eloquent\Model;

class Semestre extends Model
{
    public function materias()
    {
    	return $this->hasMany(Materia::class);
    }
}
