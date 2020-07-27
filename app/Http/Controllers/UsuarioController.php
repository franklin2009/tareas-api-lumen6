<?php

namespace App\Http\Controllers;

use App\Http\Models\Usuario;
use Illuminate\Http\Request;

class UsuarioController extends Controller
{

    public function index()
    {
       $usuarios = Usuario::all();
       return response()->json($usuarios);
    }

    public function create(Request $request)
    {
       $usuario = new Usuario;
       $usuario->nombre= $request->nombre;
       $usuario->email = $request->email;
	   $usuario->avatar= md5($usuario->email);
       $usuario->save();
       return response()->json($usuario);
    }
	
	public function show($id)
    {
        $usuario = Usuario::find($id);
        return response()->json($usuario);
    }
}
