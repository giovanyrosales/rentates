<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Frontend\Login\LoginController;
use App\Http\Controllers\Controles\ControlController;
use App\Http\Controllers\Backend\Perfil\PerfilController;
use App\Http\Controllers\Backend\RolesPermisos\RolesController;
use App\Http\Controllers\Backend\RolesPermisos\PermisosController;
use App\Http\Controllers\Backend\Proveedor\ProveedorController;
use App\Http\Controllers\Backend\Empleado\EmpleadoController;
use App\Http\Controllers\Backend\Empleado\ImportarController;
use App\Http\Controllers\Backend\Empleado\ExportarController;
use App\Http\Controllers\Backend\Configuraciones\TipoProController;
use App\Http\Controllers\Backend\Configuraciones\CodigoPaisController;
use App\Http\Controllers\Backend\Configuraciones\CodigoRetController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [LoginController::class,'index'])->name('login');

Route::post('admin/login', [LoginController::class, 'login']);
Route::post('admin/logout', [LoginController::class, 'logout'])->name('admin.logout');

// --- CONTROL WEB ---
Route::get('/panel', [ControlController::class,'indexRedireccionamiento'])->name('admin.panel');
Route::get('/admin/inicio', [ControlController::class,'getInicio'])->name('admin.inicio');
Route::get('/admin/roles/index', [RolesController::class,'index'])->name('admin.roles.index');


     // --- ROLES ---
    Route::get('/admin/roles/tabla', [RolesController::class,'tablaRoles']);
    Route::get('/admin/roles/lista/permisos/{id}', [RolesController::class,'vistaPermisos']);
    Route::get('/admin/roles/permisos/tabla/{id}', [RolesController::class,'tablaRolesPermisos']);
    Route::post('/admin/roles/permiso/borrar', [RolesController::class, 'borrarPermiso']);
    Route::post('/admin/roles/permiso/agregar', [RolesController::class, 'agregarPermiso']);
    Route::get('/admin/roles/permisos/lista', [RolesController::class,'listaTodosPermisos']);
    Route::get('/admin/roles/permisos-todos/tabla', [RolesController::class,'tablaTodosPermisos']);
    Route::post('/admin/roles/borrar-global', [RolesController::class, 'borrarRolGlobal']);

    // --- PERMISOS ---
    Route::get('/admin/permisos/index', [PermisosController::class,'index'])->name('admin.permisos.index');
    Route::get('/admin/permisos/tabla', [PermisosController::class,'tablaUsuarios']);
    Route::post('/admin/permisos/nuevo-usuario', [PermisosController::class, 'nuevoUsuario']);
    Route::post('/admin/permisos/info-usuario', [PermisosController::class, 'infoUsuario']);
    Route::post('/admin/permisos/editar-usuario', [PermisosController::class, 'editarUsuario']);
    Route::post('/admin/permisos/nuevo-rol', [PermisosController::class, 'nuevoRol']);
    Route::post('/admin/permisos/extra-nuevo', [PermisosController::class, 'nuevoPermisoExtra']);
    Route::post('/admin/permisos/extra-borrar', [PermisosController::class, 'borrarPermisoGlobal']);

    // --- PERFIL ---
    Route::get('/admin/editar-perfil/index', [PerfilController::class,'indexEditarPerfil'])->name('admin.perfil');
    Route::post('/admin/editar-perfil/actualizar', [PerfilController::class, 'editarUsuario']);

    // --- CONFIGURACIONES ---
            // --- Tipo de Proveedor ---
            Route::get('/admin/tipoproveedor/index', [TipoProController::class,'index'])->name('admin.tipopro.index');
            Route::post('/admin/tipoproveedor/add_tipopro', [TipoProController::class, 'add_tipopro']);
            Route::post('/admin/tipoproveedor/get_tipopro', [TipoProController::class, 'get_tipopro']);
            Route::post('/admin/tipoproveedor/update_tipopro', [TipoProController::class, 'update_tipopro']);
            Route::post('/admin/tipoproveedor/delete_tipopro', [TipoProController::class, 'delete_tipopro']);
            // --- Codigo de Pais ---
            Route::get('/admin/codigopais/index', [CodigoPaisController::class,'index'])->name('admin.codigopais.index');
            Route::post('/admin/codigopais/add_codigopais', [CodigoPaisController::class, 'add_codigopais']);
            Route::post('/admin/codigopais/get_codigopais', [CodigoPaisController::class, 'get_codigopais']);
            Route::post('/admin/codigopais/update_codigopais', [CodigoPaisController::class, 'update_codigopais']);
            Route::post('/admin/codigopais/delete_codigopais', [CodigoPaisController::class, 'delete_codigopais']);
            // --- Codigo de Retencion ---
            Route::get('/admin/codigoret/index', [CodigoRetController::class,'index'])->name('admin.codigoret.index');
            Route::post('/admin/codigoret/add_codigoret', [CodigoRetController::class, 'add_codigoret']);
            Route::post('/admin/codigoret/get_codigoret', [CodigoRetController::class, 'get_codigoret']);
            Route::post('/admin/codigoret/update_codigoret', [CodigoRetController::class, 'update_codigoret']);
            Route::post('/admin/codigoret/delete_codigoret', [CodigoRetController::class, 'delete_codigoret']);

        // --- proveedor - ROL ENCARGADO Renta
        Route::get('/admin/proveedor/index', [ProveedorController::class,'index'])->name('admin.proveedor.index');
        Route::post('admin/proveedor/add_proveedor', [ProveedorController::class, 'add_proveedor']);
        Route::post('admin/proveedor/get_proveedor', [ProveedorController::class, 'get_proveedor']);
        Route::post('admin/proveedor/update_proveedor', [ProveedorController::class, 'update_proveedor']);
        Route::post('admin/proveedor/delete_proveedor', [ProveedorController::class, 'delete_proveedor']);
            //Retenciones de Proveedor
            Route::post('admin/proveedor/get_proveedor_ret', [ProveedorController::class, 'get_proveedor_ret']);
            Route::post('admin/proveedor/registroret_proveedor', [ProveedorController::class, 'registroret_proveedor']);
            Route::get('admin/proveedor/historial_ret/{id}', [ProveedorController::class,'historial_ret']);
            Route::post('admin/proveedor/get_historial_pro', [ProveedorController::class, 'get_historial_pro']);
            Route::post('admin/proveedor/update_registroret', [ProveedorController::class, 'update_registroret']);
            Route::post('admin/proveedor/delete_registroret', [ProveedorController::class, 'delete_registroret']);

        // --- empleado - ROL ENCARGADO Renta
        Route::get('/admin/empleado/index', [EmpleadoController::class,'index'])->name('admin.empleado.index');
        Route::post('admin/empleado/add_empleado', [EmpleadoController::class, 'add_empleado']);
        Route::post('admin/empleado/get_empleado', [EmpleadoController::class, 'get_empleado']);
        Route::post('admin/empleado/update_empleado', [EmpleadoController::class, 'update_empleado']);
        Route::post('admin/empleado/delete_empleado', [EmpleadoController::class, 'delete_empleado']);

        //Importar archivo CSV de empleados
        Route::get("/admin/empleado/data", [ImportarController::class, "index"]);
        Route::post('admin/empleado/cargar_datos', [ImportarController::class, 'cargar_datos']);
        Route::post('admin/empleado/import',  [ImportarController::class,  'import']);
        Route::post('admin/empleado/registrolistret_emp', [ImportarController::class, 'registrolistret_emp']);

            //Retenciones de Empleado
            Route::post('admin/empleado/get_empleado_ret', [EmpleadoController::class, 'get_empleado_ret']);
            Route::post('admin/empleado/registroret_emp', [EmpleadoController::class, 'registroret_emp']);
            Route::get('admin/empleado/historial_ret/{id}', [EmpleadoController::class,'historial_ret']);
            Route::post('admin/empleado/get_historial_emp', [EmpleadoController::class, 'get_historial_emp']);
            Route::post('admin/empleado/update_registroret', [EmpleadoController::class, 'update_registroret']);
            Route::post('admin/empleado/delete_registroret', [EmpleadoController::class, 'delete_registroret']);

            //Reportes
            Route::get("/admin/reporte/generar", [ExportarController::class, "index"])->name('admin.reportes.index');
            //Route::get('/tasks', [ExportarController::class,'exportCsv']);
            Route::get('/admin/tasks/{fecha}', [ExportarController::class,'exportCsv']);

    // --- SIN PERMISOS VISTA 403 ---
    Route::get('sin-permisos', [ControlController::class,'indexSinPermiso'])->name('no.permisos.index');
