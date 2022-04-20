<?php

namespace App\Http\Controllers\Backend\Configuraciones;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TipoPro;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Validator;

class TipoProController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }
  //retornar index de tipos de prveedores
  public function index(){
        
    $tipopro = TipoPro::all();    
        return view('backend.admin.Configuraciones.Listar_Tipopro',compact('tipopro'));
}  
//retornar un tipo de proveedor en especifico para actualizar
public function get_tipopro(Request $request){
    if($request->isMethod('post')){    

        if($datos = DB::Table('tipopro')->where('id', $request->id)->first()){
            return [
                'success' => 1,
                'tipopro' => $datos
            ];
        }else{
            return [
                'success' => 2 // proveedor no encontrado                   
            ];
        }
    }
}

// agregar nuevo tipo de proveedor
public function add_tipopro(Request $request){ 
    if($request->isMethod('post')){  

    $regla = array(      
        'nombre' => 'required',
            );

    $mensaje = array(
        'nombre.required' => 'Nombre requerido'
        );

    $validar = Validator::make($request->all(), $regla, $mensaje );

    if ($validar->fails())
    {
        return [
            'success' => 0, 
            'message' => $validar->errors()->all()
        ];
    }   

        $creartipopro = TipoPro::insertGetId([
            'nombre'=>$request->nombre]); 

    if($creartipopro){               
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
 // editar tipo de proveedor
public function update_tipopro(Request $request){

if($request->isMethod('post')){  

    // encontrar tipo de proveedor a actualizar
    if($area = DB::table('tipopro')->where('id', $request->id)->first()){                        

        
            DB::table('tipopro')->where('id', '=', $request->id)->update(['nombre' => $request->nombre]);
            
            return [
                'success' => 1 // datos guardados correctamente
            ];                    
    
     }else{
        return [
            'success' => 3 //tipo de proveedor no encontrado
        ];
    }
}
}
  // eliminar un tipo de proveedor
public function delete_tipopro(Request $request){
if($request->isMethod('post')){  

    if($datos = DB::table('tipopro')->where('id', $request->id)->first()){
        // borrar un tipo de proveedor
        DB::table('tipopro')->where('id', $request->id)->delete();
        
        return [
            'success' => 1 // tipo de proveedor eliminado
        ];
    }else{
        return [
            'success' => 2 // tipo de proveedor no encontrado
        ];
        }
    }
}
}
