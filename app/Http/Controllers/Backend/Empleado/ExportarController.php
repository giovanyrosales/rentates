<?php

namespace App\Http\Controllers\Backend\Empleado;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CodigoPais;
use App\Models\Usuario;
use App\Models\Empleado;
use App\Models\proveedor;
use App\Models\CodigoRet;
use App\Models\CalculoEmp;
use App\Models\CalculoPro;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class ExportarController extends Controller
{
       //retornar index de generar csv
       public function index(){
            return view('backend.admin.Reportes.generarCsv');
    }  


    public function exportCsv($fecha)
    {
        $fileName = 'retenciones_lista.csv';
        //$tasks = Empleado::all();

          $startDate =  $fecha.'-01';
          $endDate =  $fecha.'-30';

          $porcionesfec = explode("-", $fecha);
          $periodo = ltrim($porcionesfec[1].$porcionesfec[0],'0');
         // Log:info ($periodo);
      
        $tasks1 = CalculoEmp::whereBetween('fecharet', [$startDate, $endDate])->get();
        $tasks2 = CalculoPro::whereBetween('fecharet', [$startDate, $endDate])->get();
        
     
             $headers = array(
                 "Content-type"        => "text/csv",
               "Content-Disposition" => "attachment; filename=$fileName",
                 "Pragma"              => "no-cache",
                "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
                "Expires"             => "0"
             );
     
             //$columns = array('Id', 'Nombre', 'Apellido', 'DUI', 'NIT', 'Domiciliado', 'Codigo Pais');
     
             $callback = function() use($tasks1, $tasks2, $periodo) {
             $file = fopen('php://output', 'w');                
               // fputcsv($file, $columns, ';');

                foreach ($tasks1 as $task) {
                $row['empleado_id']  = $task->empleado_id;
                $row['codigopais_id']    = $task->codigopais_id;
                $row['codigoret_id']    = $task->codigoret_id;
                $row['montodevengado']    = $task->montodevengado;
                $row['devengadobono']    = $task->devengadobono;
                $row['impuestoret']  = $task->impuestoret;
                $row['aguinaldoexen']  = $task->aguinaldoexen;
                $row['aguinaldograv']  = $task->aguinaldograv;
                $row['afp']  = $task->afp;
                $row['isss']  = $task->isss;
                $row['inpep']  = $task->inpep;
                $row['ipsfa']  = $task->ipsfa;
                $row['cefafa']  = $task->cefafa;
                $row['bienmagis']  = $task->bienmagis;
                $row['isssivm']  = $task->isssivm;
                $empleadodata = Empleado::where('id', $row['empleado_id'])->first();
                $paisdata = CodigoPais::where('id', $empleadodata['codigopais_id'])->first();
                $codigodata = Codigoret::where('id', $row['codigoret_id'])->first();

              fputcsv($file, array($empleadodata['domiciliado'], $paisdata['codigo'], strtoupper($empleadodata['apellido']).' '.strtoupper($empleadodata['nombre']), $empleadodata['nit'],$empleadodata['dui'], $codigodata['codigo'],$row['montodevengado'], $row['devengadobono'], $row['impuestoret'], $row['aguinaldoexen'], $row['aguinaldograv'], $row['afp'], $row['isss'], $row['inpep'], $row['ipsfa'], $row['cefafa'], $row['bienmagis'], $row['isssivm'], $periodo), ';');
           }  
                foreach ($tasks2 as $task2) {
                  $row['proveedor_id']  = $task2->proveedor_id;
                  $row['partida']    = $task2->partida;
                  $row['numfactura']    = $task2->numfactura;
                  $row['monto']  = $task2->monto;
                  $row['montoret']  = $task2->montoret;

                  $proveedordata = Proveedor::where('id', $row['proveedor_id'])->first();
                  $codigodata = Codigoret::where('id', $row['codigoret_id'])->first();

                fputcsv($file, array('1','9300', strtoupper($proveedordata['nombre']), $proveedordata['nit'],$proveedordata['dui'], $codigodata['codigo'], $row['monto'],'0', $row['montoret'],'0', '0','0','0','0','0','0','0','0', $periodo), ';');
              }
            
                fclose($file);
             };
              
             return response()->stream($callback, 200, $headers);   
            }
}
