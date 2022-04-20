<?php

namespace App\Http\Controllers\Backend\Empleado;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Empleado;
use App\Models\CodigoRet;
use App\Models\CalculoEmp;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class ImportarController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    private $rows = [];
    
    public function import(Request $request)
    {
        $path = $request->file('file')->getRealPath();
        $records = array_map('str_getcsv', file($path));
        //Comprobar si el archivo de excel esta vacio
        if (! count($records) > 0) {
           return 'Error...';
        }

        // Get field names from header column
        $fields = array_map('strtolower', $records[0]);
        
        // retira la primera fila del array, que es donde esta el header
        array_shift($records);
        $datos = array();
        $id_empleado = '';
        foreach ($records as $record) {
            //Comprobar si la cantidad de headers coincide con la cantidad de columnas de datos
            if (count($fields) != count($record)) {
                return 'csv_upload_invalid_data';
            }
            
            
            // Decode unwanted html entities
            $record =  array_map("html_entity_decode", $record);
            
            // Set the field name as key
            //$record = array_combine($fields, $record);

            //Separo el array en porciones que contiene el valor de cada celda
            $porciones = explode(";", $record[0]);

            //Extraer el primer apellido del empleado para hacerlo coincidir con el dui
            $primerapellido = explode(" ", $porciones[1]);
            
            //comprobar si el empleado esta en la base de datos
            if(!$existe = DB::Table('empleado')->where('dui', str_replace("-","",$porciones[2]))->first()){
                return [
                    'success' => 2,
                    'dui' => $porciones[2]
                ];
            }else {
                $datosempleado = DB::Table('empleado')->where('dui', str_replace("-","",$porciones[2]))->first();
               // Log:info (strtolower($primerapellido[0]).' '.strtolower($datosempleado->apellido)); 
                $id_empleado = $datosempleado->id;
                if(strpos(strtolower($datosempleado->apellido), strtolower($primerapellido[0])) === false){
                    
                    return [
                           'success' => 3,
                            'dui' => $porciones[2]
                    ];

                        // Get the clean data
                    //$this->rows[] = $this->clear_encoding_str($record);
                }
            }
            //Creo un nuevo arreglo con las celdas establecidas en el archivo de excel
            $datos[] = [
                'empleado_id'=> $id_empleado,
                'cod'=> $porciones[0],
                'nombre'=> $porciones[1],
                'dui'=> str_replace("-","",$porciones[2]),
                'sueldo'=> $porciones[3],
                'totaldevengado'=> $porciones[4],
                'montoret'=> $porciones[5],
                'impuestoret'=> $porciones[6],
                'afpcrecer'=> $porciones[7],
                'afpconfia'=> $porciones[8],
                'inpep'=> $porciones[9],
                'ipsfa'=> $porciones[10],
                'isss'=> $porciones[11],
                'vacaciones'=> $porciones[12],
                'horasextra'=> $porciones[13],
                'aguinaldo'=> $porciones[14],
                'incapacidad'=> $porciones[15]
            ];
        }
        
        return [
            'success' => 1,
            'lista' => $datos
        ];
        
            //Log:info ($data);
            //Comprobar si el registro coincide con algun empleado registrado con dui -- YA
            //comprobar si el registro de dui coincide con el nombre -- YA
            //comprobar si falta algun registro comparado con la base de datos de empleados -- Falta, depende de que tan completo venga el listado

    }
    
    private function clear_encoding_str($value)
    {
        if (is_array($value)) {
            $clean = [];
            foreach ($value as $key => $val) {
                $clean[$key] = mb_convert_encoding($val, 'UTF-8', 'UTF-8');
            }
            return $clean;
        }
        return mb_convert_encoding($value, 'UTF-8', 'UTF-8');
    }


    // editar Registro de retencion especifico
    public function registrolistret_emp(Request $request){
        DB::beginTransaction();

    try {
       
            // actualizar registros
                for ($i = 0; $i < count($request->empleado_id); $i++) {
                    $dd = new CalculoEmp();
                    $dd->empleado_id = $request->empleado_id[$i];
                    $dd->fecharet = $request->fecharet;
                    $dd->codigoret_id = $request->codigoret_id[$i];
                    $dd->montodevengado = $request->montodevengado[$i];
                    $dd->devengadobono = $request->devengadobono[$i];
                    $dd->impuestoret = $request->impuestoret[$i];
                    $dd->aguinaldoexen = $request->aguinaldoexen[$i];
                    $dd->aguinaldograv = $request->aguinaldograv[$i];
                    $dd->afp = $request->afp[$i];
                    $dd->isss = $request->isss[$i];
                    $dd->inpep = $request->inpep[$i];
                    $dd->ipsfa = $request->ipsfa[$i];
                    $dd->cefafa = $request->cefafa[$i];
                    $dd->bienmagis = $request->bienmagis[$i];
                    $dd->isssivm = $request->isssivm[$i];

                    $dd->save();
                    
            }
                DB::commit();
                return ['success' => 1];

        }catch(\Throwable $e){
            //Log::info('e'.$e);
            //Log::info($request->codigoret_id);
            DB::rollback();

            return ['success' => 2];
            
        }
    
        
    }
}
