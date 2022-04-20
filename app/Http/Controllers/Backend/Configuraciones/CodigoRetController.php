<?php

namespace App\Http\Controllers\Backend\Configuraciones;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Validator;
use App\Models\CodigoRet;


class CodigoRetController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }
  //retornar index de codigoret
  public function index(){
        
    $codigoret = CodigoRet::all();    
        return view('backend.admin.Configuraciones.Listar_CodigoRet',compact('codigoret'));
}  
//retornar un codigoret en especifico para actualizar
public function get_codigoret(Request $request){
    if($request->isMethod('post')){    

        if($datos = DB::Table('codigoret')->where('id', $request->id)->first()){
            return [
                'success' => 1,
                'codigoret' => $datos
            ];
        }else{
            return [
                'success' => 2 // codigoret no encontrado                   
            ];
        }
    }
}

// agregar nuevo codigoret
public function add_codigoret(Request $request){ 
    if($request->isMethod('post')){  

    $regla = array(      
        'nombre' => 'required',
        'codigo' => 'required'
            );

    $mensaje = array(
        'nombre.required' => 'Nombre requerido',
        'codigo.required' => 'Codigo requerido'
        );

    $validar = Validator::make($request->all(), $regla, $mensaje );

    if ($validar->fails())
    {
        return [
            'success' => 0, 
            'message' => $validar->errors()->all()
        ];
    }   

        $crearcodigoret = CodigoRet::insertGetId([
            'nombre'=>$request->nombre,
            'codigo'=>$request->codigo]); 


    if($crearcodigoret){               
            return [
                'success' => 1
            ];
        }else{
            return [
                'success' => 2 //
            ];
        }

    }
}
 // editar codigoret
public function update_codigoret(Request $request){

if($request->isMethod('post')){  

    // encontrar codigoret a actualizar
    if($area = DB::table('codigoret')->where('id', $request->id)->first()){                        

        
            DB::table('codigoret')->where('id', '=', $request->id)->update(['nombre' => $request->nombre, 'codigo' => $request->codigo]);
            
            return [
                'success' => 1 // datos guardados correctamente
            ];                    
    
     }else{
        return [
            'success' => 3 //codigoret no encontrado
        ];
    }
}
}
  // eliminar un codigoret
public function delete_codigoret(Request $request){
if($request->isMethod('post')){  

    if($datos = DB::table('codigoret')->where('id', $request->id)->first()){
        // borrar un codigoret
        DB::table('codigoret')->where('id', $request->id)->delete();
        
        return [
            'success' => 1 // codigoret eliminado
        ];
    }else{
        return [
            'success' => 2 //codigoret no encontrado
        ];
        }
    }
}
}
