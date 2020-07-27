<?php

namespace App\Http\Controllers;

use App\Http\Models\Tarea;
use App\Http\Models\Usuario;
use Illuminate\Http\Request;

class TareaController extends Controller
{

    public function index()
    {
	  \Carbon\Carbon::setLocale('es');
       $tareas = Tarea::with('usuario')->get()->map(function ($tarea) {
		    $tarea->tiempo=$this->getTiempo($tarea->fecha);	
			return $tarea;
		});
       return response()->json($tareas);
    }

    public function create(Request $request)
    {
       $tarea = new Tarea;
       $tarea->titulo= $request->titulo;
       $tarea->descripcion = $request->descripcion;
	   $tarea->usuario_id= $request->usuario_id; 
	   $f=substr($request->tiempo['fecha'],0,10);
	   $h=$request->tiempo['hora'];
	   $m=$request->tiempo['minuto'];
       $tarea->fecha= $f." ".($h<10?'0'.$h:$h).":".($m<10?'0'.$m:$m).":00";
       $tarea->estatus= 'A';
       $tarea->save();
	   \Carbon\Carbon::setLocale('es');
	   $tarea->tiempo=$this->getTiempo($tarea->fecha);	
	   $tarea->usuario=Usuario::find($tarea->usuario_id);
       return response()->json($tarea);
    }
	
	public function show($id)
     {
        $tarea = Tarea::find($id);
        return response()->json($tarea);
     }

    public function update($id, Request $request)
     { 
        $tarea= Tarea::find($id);
        $tarea->titulo = $request->titulo;
        $tarea->descripcion = $request->descripcion;
        $tarea->usuario_id = $request->usuario_id;
		$f=substr($request->tiempo['fecha'],0,10);
	    $h=$request->tiempo['hora'];
	    $m=$request->tiempo['minuto'];
        $tarea->fecha= $f." ".($h<10?'0'.$h:$h).":".($m<10?'0'.$m:$m).":00";
		if(isset($request->status)){
			$tarea->estatus= 'F';
		}
        $tarea->save();
		\Carbon\Carbon::setLocale('es');
	    $tarea->tiempo=$this->getTiempo($tarea->fecha);	
	    $tarea->usuario=Usuario::find($tarea->usuario_id);
        return response()->json($tarea);
     }
	 
	 public function updateDate($id,Request $request)
     { 
        $tarea= Tarea::find($id);
		$f=substr($request->tiempo['fecha'],0,10);
	    $h=$request->tiempo['hora'];
	    $m=$request->tiempo['minuto'];
        $tarea->fecha= $f." ".($h<10?'0'.$h:$h).":".($m<10?'0'.$m:$m).":00";
        $tarea->save();
		\Carbon\Carbon::setLocale('es');
	    $tarea->tiempo=$this->getTiempo($tarea->fecha);
        return response()->json($tarea);
     }

     public function destroy($id)
     {
        $tarea = Tarea::find($id);
        $tarea->delete();
        return response()->json('borrado exitoso');
     }
	 
	 private function getTiempo($fecha)
	 {
	   list($f, $fh) = explode(' ', $fecha); // 2020-02-20 12:00:00
	   list($h, $m, $s) = explode(':', $fh); // 12:00:00
	   $r = \Carbon\Carbon::createFromTimeStamp(strtotime($fecha))->diffForHumans();
	   $tiempo=['fecha'=>$f,'hora'=>$h,'minuto'=>$m,'resta'=>$r];
	   return $tiempo;
	 }
}
