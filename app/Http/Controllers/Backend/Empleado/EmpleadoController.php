<?php

namespace App\Http\Controllers\Backend\Empleado;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CodigoPais;
use App\Models\Usuario;
use App\Models\Empleado;
use App\Models\CodigoRet;
use App\Models\CalculoEmp;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use function PHPUnit\Framework\isEmpty;

class EmpleadoController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }
    //retornar index de empleados
    public function index(){
        
        $empleados = Empleado::all();
        $codigopais = CodigoPais::all();
        $codigoret = CodigoRet::all();
            return view('backend.admin.Empleado.Listar_Empleado',compact('empleados', 'codigopais', 'codigoret'));
    }  

        //retornar un empleado en especifico para actualizar
        public function get_empleado(Request $request){
            if($request->isMethod('post')){    
        
                if($datos = DB::Table('empleado')->where('id', $request->id)->first()){
                    return [
                        'success' => 1,
                        'empleado' => $datos
                    ];
                }else{
                    return [
                        'success' => 2 // empleado no encontrado                   
                    ];
                }
            }
        }

        // agregar nuevo empleado
    public function add_empleado(Request $request){ 
        if($request->isMethod('post')){  
    
        $regla = array( 
            'codigopais_id' => 'required',        
            'nombre' => 'required',
            'dui' => 'required',
                );

        $mensaje = array(
            'codigopais_id.required' => 'Codigo de Pais Requerido',
            'nombre.required' => 'Nombre requerido',
            'dui.required' => 'Nombre requerido'
            );

        $validar = Validator::make($request->all(), $regla, $mensaje );

        if ($validar->fails())
        {
            return [
                'success' => 0, 
                'message' => $validar->errors()->all()
            ];
        }   
            $crearempleado = Empleado::insertGetId([
                'codigopais_id'=>$request->codigopais_id,
                'nit'=>$request->nit,
                'dui'=>$request->dui,
                'nombre'=>$request->nombre,
                'apellido'=>$request->apellido, 
                'domiciliado'=>$request->domiciliado]); 

        if($crearempleado){               
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

         // editar Empleados
public function update_empleado(Request $request){

    if($request->isMethod('post')){  

        // encontrar empleado a actualizar
        if($area = DB::table('empleado')->where('id', $request->id)->first()){                        

            
                DB::table('empleado')->where('id', '=', $request->id)->update(['nombre' => $request->nombre,'apellido' => $request->apellido, 'nit' => $request->nit, 'dui' => $request->dui, 'codigopais_id' => $request->codigopais_id, 'domiciliado' => $request->domiciliado]);
                
                return [
                    'success' => 1 // datos guardados correctamente
                ];                    
        
         }else{
            return [
                'success' => 3 //empleado no encontrado
            ];
        }
    }
}

    // eliminar un empleado
  public function delete_empleado(Request $request){
    if($request->isMethod('post')){  

        if($datos = DB::table('empleado')->where('id', $request->id)->first()){
            // borrar un empleado
            DB::table('empleado')->where('id', $request->id)->delete();
            
            return [
                'success' => 1 // empleado eliminado
            ];
        }else{
            return [
                'success' => 2 // empleado no encontrado
            ];
            }
        }
    }
//***************************************PARA REGISTRAR RETENCION  */
     //retornar un empleado en especifico para agregar datos de retencion
     public function get_empleado_ret(Request $request){
        if($request->isMethod('post')){    
    
            if($datos = DB::Table('empleado')->where('id', $request->id)->first()){
                return [
                    'success' => 1,
                    'empleado' => $datos
                ];
            }else{
                return [
                    'success' => 2 // empleado no encontrado                   
                ];
            }
        }
    }
        // agregar registro de retencion para empleado
    public function registroret_emp(Request $request){ 
        if($request->isMethod('post')){  

        $regla = array( 
            'codigoret_id' => 'required',        
            'id' => 'required'
                );

        $mensaje = array(
            'codigoret_id.required' => 'Codigo de Retencion Requerido',
            'id.required' => 'ID requerido'
            );

        $validar = Validator::make($request->all(), $regla, $mensaje );

        if ($validar->fails())
        {
            return [
                'success' => 0, 
                'message' => $validar->errors()->all()
            ];
        }   
            $registrarret = CalculoEmp::insertGetId([
                'codigoret_id'=>$request->codigoret_id,
                'empleado_id'=>$request->id,
                'fecharet'=>$request->fecharet,
                'montodevengado'=>$request->montodevengado,
                'devengadobono'=>$request->devengadobono,
                'impuestoret'=>$request->impuestoret,
                'aguinaldoexen'=>$request->aguinaldoexen,
                'aguinaldograv'=>$request->aguinaldograv,
                'afp'=>$request->afp,
                'isss'=>$request->isss,
                'inpep'=>$request->inpep,
                'ipsfa'=>$request->ipsfa,
                'cefafa'=>$request->cefafa,
                'bienmagis'=>$request->bienmagis,
                'isssivm'=>$request->isssivm]); 

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
    //retornar un historial de empleado en especifico
    public function historial_ret($id){
        $empleado = DB::Table('empleado')->where('id', $id)->first();
        $historial = DB::Table('calculoemp')->where('empleado_id', $id)->get();
        $codigoret = CodigoRet::all();
        return view('backend.admin.Empleado.Historial_Empleado',compact('empleado','historial', 'codigoret'));
    }
    //retornar un calculo en especifico para actualizar
    public function get_historial_emp(Request $request){
        if($request->isMethod('post')){    
    
            if($datos = DB::Table('calculoemp')->where('id', $request->id)->first()){
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
            if($area = DB::table('calculoemp')->where('id', $request->id)->first()){                        

                
                    DB::table('calculoemp')->where('id', '=', $request->id)->update(['codigoret_id' => $request->codigoret_id, 'fecharet' => $request->fecharet,'montodevengado' => $request->montodevengado, 'devengadobono' => $request->devengadobono, 'impuestoret' => $request->impuestoret, 'aguinaldoexen' => $request->aguinaldoexen, 'aguinaldograv' => $request->aguinaldograv, 'afp' => $request->afp, 'isss' => $request->isss, 'inpep' => $request->inpep, 'ipsfa' => $request->ipsfa, 'cefafa' => $request->cefafa, 'bienmagis' => $request->bienmagis, 'isssivm' => $request->isssivm]);
                    
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

            if($datos = DB::table('calculoemp')->where('id', $request->id)->first()){
                // borrar un calculo
                DB::table('calculoemp')->where('id', $request->id)->delete();
                
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
