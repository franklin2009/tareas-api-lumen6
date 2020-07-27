<?php

namespace App\Http\Models;

class Tarea extends ModelBase
{
	protected $table = 'tareas';
	protected $fillable = ['id','titilo','descripcion', 'fecha','estatus','usuario_id'];
	protected $hidden = ['created_at', 'updated_at'];
	
	 public function usuario()
    {
        return $this->belongsTo(Usuario::class, 'usuario_id');
    }
	
	public static function getArrayEstatus()
	{
		return array("A"=>"Activo","F"=>"Finalizado");
    }
	
	public function getEstatus(){
		$estatus=static::getArrayEstatus();
		return $estatus[$this->estatus];
    }

}