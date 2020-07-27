<?php

namespace App\Http\Models;

class Usuario extends ModelBase
{
	protected $table = 'usuarios';
	protected $fillable = ['id','avatar','nombre','email'];
	protected $hidden = ['created_at', 'updated_at'];
	
	public function tareas()
    {
        return $this->hasMany(Tarea::class);
    }

}