<?php

namespace App\Http\Controllers\Backend\Proveedor;

use App\Http\Controllers\Controller;
use App\Models\Usuario;
use App\Models\TipoPro;
use App\Models\Proveedor;
use App\Models\CalculoPro;
use App\Models\CodigoRet;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use function PHPUnit\Framework\isEmpty;

class ProveedorController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }
    //retornar index de proveedores
    public function index(){
        
        $proveedores = Proveedor::all();
        $tipopro = TipoPro::all();
        $codigoret = CodigoRet::all();
            return view('backend.admin.Proveedor.Listar_Proveedor',compact('proveedores', 'tipopro', 'codigoret'));
    }  
    //retornar un proveedor en especifico para actualizar
    public function get_proveedor(Request $request){
        if($request->isMethod('post')){    
    
            if($datos = DB::Table('proveedor')->where('id', $request->id)->first()){
                return [
                    'success' => 1,
                    'proveedor' => $datos
                ];
            }else{
                return [
                    'success' => 2 // proveedor no encontrado                   
                ];
            }
        }
    }
    //retornar un proveedor en especifico para agregar datos de retencion
    public function get_proveedor_ret(Request $request){
        if($request->isMethod('post')){    
    
            if($datos = DB::Table('proveedor')->where('id', $request->id)->first()){
                return [
                    'success' => 1,
                    'proveedor' => $datos
                ];
            }else{
                return [
                    'success' => 2 // proveedor no encontrado                   
                ];
            }
        }
    }

    // agregar nuevo proveedor
    public function add_proveedor(Request $request){ 
        if($request->isMethod('post')){  
    
        $regla = array( 
            'tipopro_id' => 'required',        
            'nombre' => 'required',
                );

        $mensaje = array(
            'tipopro_id.required' => 'Tipo de proveedor Requerido',
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
            $crearproveedor = Proveedor::insertGetId([
                'tipopro_id'=>$request->tipopro_id,
                'nit'=>$request->nit,
                'dui'=>$request->dui,
                'nombre'=>$request->nombre]); 

        if($crearproveedor){               
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

 // agregar registro de retencion
 public function registroret_proveedor(Request $request){ 
    if($request->isMethod('post')){  

    $regla = array( 
        'codigoret_id' => 'required',        
        'id' => 'required',
        'monto' => 'required',
        'montoret' => 'required'
            );

    $mensaje = array(
        'codigoret_id.required' => 'Codigo de Retencion Requerido',
        'id.required' => 'ID requerido',
        'monto.required' => 'Monto requerido',
        'montoret.required' => 'Monto de retencion requerido'
        );

    $validar = Validator::make($request->all(), $regla, $mensaje );

    if ($validar->fails())
    {
        return [
            'success' => 0, 
            'message' => $validar->errors()->all()
        ];
    }   
        $registrarret = CalculoPro::insertGetId([
            'codigoret_id'=>$request->codigoret_id,
            'proveedor_id'=>$request->id,
            'fecharet'=>$request->fecharet,
            'partida'=>$request->partida,
            'arrendamiento'=>$request->arrendamiento,
            'numfactura'=>$request->numfactura,
            'monto'=>$request->monto,
            'montoret'=>$request->montoret]); 

    if($registrarret){               
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

     // editar Proveedores
public function update_proveedor(Request $request){

    if($request->isMethod('post')){  

        // encontrar proveedor a actualizar
        if($area = DB::table('proveedor')->where('id', $request->id)->first()){                        

            
                DB::table('proveedor')->where('id', '=', $request->id)->update(['nombre' => $request->nombre, 'nit' => $request->nit, 'dui' => $request->dui, 'tipopro_id' => $request->tipopro_id]);
                
                return [
                    'success' => 1 // datos guardados correctamente
                ];                    
        
         }else{
            return [
                'success' => 3 //Proveedor no encontrado
            ];
        }
    }
}
      // eliminar un proveedor
  public function delete_proveedor(Request $request){
    if($request->isMethod('post')){  

        if($datos = DB::table('proveedor')->where('id', $request->id)->first()){
            // borrar un proveedor
            DB::table('proveedor')->where('id', $request->id)->delete();
            
            return [
                'success' => 1 // proveedor eliminado
            ];
        }else{
            return [
                'success' => 2 // proveedor no encontrado
            ];
            }
        }
    }

    //retornar un proveedor en especifico para mostrar el historial de retencion
    public function historial_ret($id){
        $proveedor = DB::Table('proveedor')->where('id', $id)->first();
        $historial = DB::Table('calculopro')->where('proveedor_id', $id)->get();
        $codigoret = CodigoRet::all();
        return view('backend.admin.Proveedor.Historial_Proveedor',compact('proveedor','historial', 'codigoret'));
    }

      //retornar un calculo en especifico para actualizar
      public function get_historial_pro(Request $request){
        if($request->isMethod('post')){    
    
            if($datos = DB::Table('calculopro')->where('id', $request->id)->first()){
                return [
                    'success' => 1,
                    'historial' => $datos
                ];
            }else{
                return [
                    'success' => 2 // calculo no encontrado                   
                ];
            }
        }
    }

            // editar Registro de retencion especifico
    public function update_registroret(Request $request){

        if($request->isMethod('post')){  

            // encontrar calculo a actualizar
            if($area = DB::table('calculopro')->where('id', $request->id)->first()){                        

                
                    DB::table('calculopro')->where('id', '=', $request->id)->update(['codigoret_id' => $request->codigoret_id, 'fecharet' => $request->fecharet,'partida' => $request->partida, 'arrendamiento' => $request->arrendamiento, 'numfactura' => $request->numfactura, 'monto' => $request->monto, 'montoret' => $request->montoret]);
                    
                    return [
                        'success' => 1 // datos guardados correctamente
                    ];                    
            
            }else{
                return [
                    'success' => 3 //registro de retencion no encontrado
                ];
            }
        }
    }
    // eliminar un calculo de retencion
    public function delete_registroret(Request $request){
        if($request->isMethod('post')){  

            if($datos = DB::table('calculopro')->where('id', $request->id)->first()){
                // borrar un calculo
                DB::table('calculopro')->where('id', $request->id)->delete();
                
                return [
                    'success' => 1 // calculo eliminado
                ];
            }else{
                return [
                    'success' => 2 // calculo no encontrado
                ];
                }
            }
        }
}