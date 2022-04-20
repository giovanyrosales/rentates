<?php

namespace App\Http\Controllers\Backend\Configuraciones;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Validator;
use App\Models\CodigoPais;

class CodigoPaisController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }
  //retornar index de codigopais
  public function index(){
        
    $codigopais = CodigoPais::all();    
        return view('backend.admin.Configuraciones.Listar_CodigoPais',compact('codigopais'));
}  
//retornar un codigopais en especifico para actualizar
public function get_codigopais(Request $request){
    if($request->isMethod('post')){    

        if($datos = DB::Table('codigopais')->where('id', $request->id)->first()){
            return [
                'success' => 1,
                'codigopais' => $datos
            ];
        }else{
            return [
                'success' => 2 // codigopais no encontrado                   
            ];
        }
    }
}

// agregar nuevo codigopais
public function add_codigopais(Request $request){ 
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

        $crearcodigopais = CodigoPais::insertGetId([
            'nombre'=>$request->nombre,
            'codigo'=>$request->codigo]); 


    if($crearcodigopais){               
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
 // editar codigopais
public function update_codigopais(Request $request){

if($request->isMethod('post')){  

    // encontrar codigopais a actualizar
    if($area = DB::table('codigopais')->where('id', $request->id)->first()){                        

        
            DB::table('codigopais')->where('id', '=', $request->id)->update(['nombre' => $request->nombre, 'codigo' => $request->codigo]);
            
            return [
                'success' => 1 // datos guardados correctamente
            ];                    
    
     }else{
        return [
            'success' => 3 //codigopais no encontrado
        ];
    }
}
}
  // eliminar un codigopais
public function delete_codigopais(Request $request){
if($request->isMethod('post')){  

    if($datos = DB::table('codigopais')->where('id', $request->id)->first()){
        // borrar un codigopais
        DB::table('codigopais')->where('id', $request->id)->delete();
        
        return [
            'success' => 1 // codigopais eliminado
        ];
    }else{
        return [
            'success' => 2 //codigopais no encontrado
        ];
        }
    }
}
}
