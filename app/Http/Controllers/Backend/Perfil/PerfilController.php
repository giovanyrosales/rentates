<?php

namespace App\Http\Controllers\Backend\Perfil;

use App\Http\Controllers\Controller;
use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class PerfilController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    public function indexEditarPerfil(){
        $usuario = auth()->user();
        return view('backend.admin.Perfil.EditarUsuario', compact('usuario'));
    }

    public function editarUsuario(Request $request){
    //comentario
    if(Usuario::where('id', $request->id)->first()){

        if(Usuario::where('usuario', $request->usuario)
            ->where('id', '!=', $request->id)->first()){
            return ['success' => 1];
        }

        $usuario = Usuario::find($request->id);
        $usuario->nombre = $request->nombre;
        $usuario->apellido = $request->apellido;
        $usuario->usuario = $request->usuario;
        
        if($request->password != null){
            $usuario->password = bcrypt($request->password);
        }
        $usuario->save();
            return ['success' => 2];
            
        }else{
            return ['success' => 3];
        }
    }
} 