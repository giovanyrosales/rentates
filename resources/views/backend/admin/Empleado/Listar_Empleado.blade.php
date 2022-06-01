@extends('backend.menus.superior')

@section('content-admin-css')
    <link href="{{ asset('css/adminlte.min.css') }}" type="text/css" rel="stylesheet" />
    <link href="{{ asset('css/dataTables.bootstrap4.css') }}" type="text/css" rel="stylesheet" />
    <link href="{{ asset('css/toastr.min.css') }}" type="text/css" rel="stylesheet" />
    <link href="{{ asset('css/responsive.bootstrap4.min.css') }}" type="text/css" rel="stylesheet" />
    <link href="{{ asset('css/buttons.bootstrap4.min.css') }}" type="text/css" rel="stylesheet" />
    <link href="{{ asset('css/estiloToggle.css') }}" type="text/css" rel="stylesheet" />
    <style>
      .modal-dialog-full-width{
        width:98% !important;
        height:98% !important;
        margin: 1%; !important;
        padding: 1%!important;
        max-width: none !important;
      }
      .modal-content-full-width{
        height:auto !important;
        min-height: 98% !important;
        border-radius: 0 !important;
      }
    </style>
@stop
  <section class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-4">
              <h1>Registro de Empleados
              </h1>
            </div>
            <div class="col-sm-2">
              <button type="button" onclick="abrirModalcsv()" class="btn btn-info btn-sm">
                <i class="fas fa-list"></i>
                Importar Datos
              </button>
          </div>
            <div class="col-sm-2">
              <button type="button" onclick="abrirModalAgregar()" class="btn btn-success btn-sm">
                <i class="fas fa-pencil-alt"></i>
                Agregar Empleado
              </button>
            </div>
          </div>
        </div>
  </section>
    <!-- seccion frame -->
  <section class="content">
    <div class="container-fluid">
        <div class="card card-light ">
          <div class="card-header">
            <h3 class="card-title">Empleados
            </h3>

            <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
              <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-remove"></i></button>
            </div>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <div class="row">
              <div class="col-md-12">
      
              <table id="example2" class="table table-bordered table-hover">
                <thead>             
                <tr>
                  <th style="width: 15%;">DUI</th>
                  <th style="width: 30%;">Nombre</th>                      
                  <th style="width: 30%;">Apellido</th>                      
                  <th style="width: 25%;">Acciones</th>                           
                </tr>
                </thead>
                <tbody>
                @foreach($empleados as $dato)
                <tr>
                  <td>{{ $dato->dui }}</td>
                  <td>{{ $dato->nombre }}</td>
                  <td>{{ $dato->apellido }}</td>      
                  <td>
                  <button type="button" class="btn btn-success btn-xs" onclick="abrirModalAgregarRet({{ $dato->id }})">
                    <i class="fas fa-pencil-alt" title="Editar"></i>&nbsp; Agregar Datos
                    </button>

                  <button type="button" class="btn btn-info btn-xs" onclick="abrirModalEditar({{ $dato->id }})">
                    <i class="fas fa-pencil-alt" title="Editar"></i>&nbsp; Editar
                    </button>

                    <button type="button" class="btn btn-danger btn-xs" onclick="abrirModalEliminar({{ $dato->id }})">
                    <i class="fas fa-trash-alt" title="Eliminar"></i>&nbsp; Eliminar
                    </button>
                    <a class="btn btn-primary btn-xs" href="{{ url('admin/empleado/historial_ret/'.$dato->id ) }}" target="frameprincipal">
                  <i class="fa fa-eye" title="Ver"></i>&nbsp; Ver </a>
                  </td>                    
                </tr>
                 @endforeach         
                </tbody>            
              </table>
             </div>
            </div>          
          </div>
       </div>
      </div>
    </section>
	
<!-- modal Agregar Empleado -->
<div class="modal fade" id="modalAgregar">
        <div class="modal-dialog modal-xl">
          <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title">Agregar nuevo Empleado</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form id="formularion">
              <div class="card-body">
                <div class="row">  
                  <div class="col-md-6">
                  <div class="form-group">
                        <label>Nombre:</label>   
                        <input type="text" class="form-control" id="nombren" name="nombren" placeholder="Nombre">
                  </div>  
                  <div class="form-group">
                        <label>Apellido:</label>   
                        <input type="text" class="form-control" id="apellidon" name="apellidon" placeholder="Apellidos">
                    </div> 
                    <div class="form-group">
                          <label>NIT:</label>   
                          <input type="text" class="form-control" id="nitn" name="nitn" placeholder="Número de Identificación Tributaria">
                      </div>
                      <div class="form-group">
                          <label>DUI:</label>   
                          <input type="text" class="form-control" id="duin" name="duin" placeholder="Doumento Único de Identidad">
                      </div>
                    <div class="form-group">
                        <label>Código de País:</label>   
                        <select class="form-control codigopais_idn" id="codigopais_idn" name="codigopais_idn">
                          @foreach($codigopais as $sel)
                          <option value="{{ $sel->id }}">{{$sel->nombre}}</option>
                          @endforeach
                        </select>
                    </div> 
                    <div class="form-group">
                        <label>Domiciliado:</label>   
                        <select class="form-control domiciliadon" id="domiciliadon" name="domiciliadon">
                          <option value="1">Domiciliado</option>
                          <option value="2">No Domiciliado</option>
                        </select>
                    </div>    
                  </div>
                </div> 
              </div>
            </form>
          </div>
          <div class="modal-footer justify-content-between">
            <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
            <button type="button" class="btn btn-primary" id="btnGuardarU" onclick="enviarModalAgregar()">Añadir</button>
          </div>          
        </div>        
      </div>      
    </div>

   <!-- modal editar Empleado -->
   <div class="modal fade" id="modalEditar">
        <div class="modal-dialog modal-xl">
          <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title">Editar Empleado</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
          <form id="formularioU">
              <div class="card-body">
                <div class="row">  
                  <div class="col-md-6"> 
                  <div class="form-group">
                        <label>Nombre:</label>   
                        <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Nombre">
                    </div>   
                    <div class="form-group">
                        <label>Apellido:</label>   
                        <input type="text" class="form-control" id="apellido" name="apellido" placeholder="Apellido">
                    </div>   
                    <div class="form-group">
                          <label>NIT:</label>   
                          <input type="text" class="form-control" id="nit" name="nit" placeholder="Número de Identificación Tributaria">
                      </div>
                      <div class="form-group">
                          <label>DUI:</label>   
                          <input type="hidden" id="idU"  name="idU"/>   
                          <input type="text" class="form-control" id="dui" name="dui" placeholder="Doumento Único de Identidad">
                      </div>
                    <div class="form-group">
                        <label>Código de País:</label>   
                        <select class="form-control codigopais_id" id="codigopais_id" name="codigopais_id">
                          @foreach($codigopais as $sel)
                          <option value="{{ $sel->id }}">{{$sel->nombre}}</option>
                          @endforeach
                        </select>
                    </div>    
                    <div class="form-group">
                        <label>Domiciliado:</label>   
                        <select class="form-control domiciliado" id="domiciliado" name="domiciliado">
                          <option value="1">Domiciliado</option>
                          <option value="2">No Domiciliado</option>
                        </select>
                    </div> 
                  </div>
                </div> 
              </div>
            </form>
          </div>
          <div class="modal-footer justify-content-between">
            <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
            <button type="button" class="btn btn-primary" id="btnGuardarU" onclick="enviarModalEditar()">Guardar</button>
          </div>          
        </div>        
      </div>      
    </div>

     <!-- modal eliminar -->
  <div class="modal fade" id="modalEliminar">
      <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Eliminar Registro de Empleado</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
              </button>
            </div>
                  <div class="modal-body">
                    <input type="hidden" id="idD" name="idD"/> <!-- id del empleado para borrarlo -->                           
                  </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>             
              <button class="btn btn-danger" id="btnBorrar" type="button" onclick="borrarempleado()">Borrar</button>
          </div>
        </div>      
      </div>        
  </div>

  <!-- modal Agregar Retencion de Empleado -->
<div class="modal fade" id="ModalAgregarRet">
        <div class="modal-dialog modal-xl">
          <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title">Ingresar Registro de Retención</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form id="formularior">
              <div class="card-body">
                <div class="row">  
                <div class="col-md-2"> 
                    <div class="form-group">
                        <label>Fecha de Retención:</label>   
                        <input type="date" class="form-control" id="fecharet" name="fecharet" placeholder="Fecha de Retención">
                    </div>
                  </div>
                  <div class="col-md-4"> 
                    <div class="form-group">
                          <label>DUI:</label>   
                          <input type="hidden" id="idUr"  name="idUr"/>  
                          <input type="text" class="form-control" id="duir" name="duir" readonly placeholder="Número de Identificación Tributaria">
                    </div>
                  </div>  
                  <div class="col-md-5">
                    <div class="form-group">
                          <label>Nombre:</label>   
                          <input type="text" class="form-control" id="nombrer" name="nombrer" readonly placeholder="Nombre">
                    </div>
                  </div>
                </div> 
                <div class="row">  
                  
                  <div class="col-md-5">
                    <div class="form-group">
                        <label>Código de Retención:</label>   <br>
                        <select class="form-control codigoret_id" id="codigoret_id" name="codigoret_id">
                          @foreach($codigoret as $sel)
                          <option value="{{ $sel->id }}">{{ $sel->codigo }} {{ $sel->nombre }}</option>
                          @endforeach
                        </select>
                    </div>
                  </div>
                </div><div class="row">  
                  <div class="col-md-3"> 
                    <div class="form-group">
                        <label>Sueldo:</label>   
                        <input type="number" class="form-control" step="any" id="sueldo" name="sueldo" placeholder="Sueldo">
                    </div>     
                  </div> 
                  <div class="col-md-3"> 
                    <div class="form-group">
                        <label>Vacaciones:</label>   
                        <input type="number" class="form-control" step="any" id="vacaciones" name="vacaciones" placeholder="Vacaciones">
                    </div>     
                  </div> 
                  <div class="col-md-3"> 
                    <div class="form-group">
                        <label>Horas Extra:</label>   
                        <input type="number" class="form-control" step="any" id="horasextra" name="horasextra" placeholder="Horas Extra">
                    </div>     
                  </div> 
                  <div class="col-md-3"> 
                    <div class="form-group">
                        <label>Incapacidades:</label>   
                        <input type="number" class="form-control" step="any" id="incapacidades" name="incapacidades" placeholder="Incapacidades">
                    </div>     
                  </div> 
                </div>    
                <div class="row">
                <div class="col-md-3"> 
                    <div class="form-group">
                        <label>Aguinaldo Exento:</label>   
                        <input type="number" class="form-control" step="any" id="aguinaldoexen" name="aguinaldoexeni" placeholder="Aguinaldo Exento">
                    </div>     
                  </div> 
                  <div class="col-md-3"> 
                    <div class="form-group">
                        <label>Aguinaldo Gravado:</label>   
                        <input type="number" class="form-control" step="any" id="aguinaldograv" name="aguinaldograv" placeholder="Aguinaldo Gravado">
                    </div>     
                  </div>   
                  <div class="col-md-3"> 
                    <div class="form-group">
                        <label>Otros Ingresos:</label>   
                        <input type="number" class="form-control" step="any" id="otrosingresos" name="otrosingresos" placeholder="Otros Ingresos">
                    </div>     
                  </div> 
                  <div class="col-md-3"> 
                    <div class="form-group">
                        <label>Impuesto Ret.:</label>   
                        <input type="number" class="form-control" step="any" id="impuestoret" name="impuestoret" placeholder="Impuesto Ret">
                    </div>     
                  </div> 
                </div> 
                <div class="row">  
                  <div class="col-md-3">     
                    <div class="form-group">
                        <label>CONFIA:</label>   
                        <input type="number" class="form-control"  step="any" id="confia" name="confia" placeholder="AFP">
                    </div>
                  </div> 
                  <div class="col-md-3">     
                    <div class="form-group">
                        <label>CRECER:</label>   
                        <input type="number" class="form-control"  step="any" id="crecer" name="crecer" placeholder="AFP">
                    </div>
                  </div>  
                  <div class="col-md-3">   
                    <div class="form-group">
                        <label>ISSS:</label>   
                        <input type="number" class="form-control" step="any" id="isss" name="isss" placeholder="ISSS">
                    </div> 
                  </div> 
                 
                </div> 
                <div class="row">  
                  <div class="col-md-3">     
                    <div class="form-group">
                        <label>IPSFA:</label>   
                        <input type="number" class="form-control"  step="any" id="ipsfa" name="ipsfa" placeholder="IPSFA">
                    </div>
                  </div>  
                  <div class="col-md-3">   
                    <div class="form-group">
                        <label>INPEP:</label>   
                        <input type="number" class="form-control"   step="any" id="inpep" name="inpep" placeholder="INPEP">
                    </div> 
                  </div>  
                </div> 
              </div>
            </form>
          </div>
          <div class="modal-footer justify-content-between">
            <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
            <button type="button" class="btn btn-primary" id="btnGuardarU" onclick="enviarModalRet()">Agregar</button>
          </div>          
        </div>        
      </div>      
    </div>

 <!-- modal Agregar Listado Retencion de Empleados -->
      <div class="modal fade right" id="ModalguardarlistaRet" tabindex="-1" role="dialog" aria-labelledby="ModalguardarlistaRet" aria-hidden="true">
        <div class="modal-dialog-full-width modal-dialog momodel modal-fluid" role="document">
            <div class="modal-content-full-width modal-content ">
                <div class=" modal-header-full-width   modal-header text-center">
                    <h5 class="modal-title w-100" id="ModalguardarlistaRet">Registro General de Retenciones</h5>
                    <button type="button" class="close " data-dismiss="modal" aria-label="Close">
                        <span style="font-size: 1.3em;" aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                  <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Fecha de Retención:</label>   
                            <input type="date" class="form-control" id="fecharetl" name="fecharetl" placeholder="Fecha de Retención">
                        </div>
                    </div>
                    <div class="col-md-12">
                      <table id="example23" class="table table-bordered table-hover">
                      <thead>             
                          <tr>
                            <th style="width: 15%;">Nombre</th>
                            <th style="width: 10%;">Cod. Ret</th>                      
                            <th style="width: 6%;">Monto Devengado</th>  
                            <th style="width: 6%;">Devengado Bono</th>
                            <th style="width: 6%;">Impuesto Ret.</th>   
                            <th style="width: 6%;">Aguinaldo Exento</th>                      
                            <th style="width: 6%;">Aguinaldo Gravado</th>   
                            <th style="width: 6%;">AFP</th>   
                            <th style="width: 6%;">ISSS</th>   
                            <th style="width: 6%;">INPEP</th>   
                            <th style="width: 6%;">IPSFA</th>   
                            <th style="width: 6%;">CEFAFA</th>
                            <th style="width: 6%;">ISSSIVM</th>   
                            <th style="width: 6%;">Bien Magist.</th>   
                          </tr>
                        </thead>
                        <tbody>
                        </tbody>            
                      </table>
                    </div>
                  </div> 
                </div>
                <div class="modal-footer-full-width  modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" onclick="enviarTablaRet()">Guardar</button>
                </div>
              </div>
          </div>
      </div>

        <!-- Modal -->
  <div class="modal fade" id="modalcsv" tabindex="-1" aria-labelledby="modalcsv" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title">Subir archivo CSV</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
          <form class="form" method="POST" enctype="multipart/form-data">
           <div class="card-body">
                <input type="file" name="file" class="form-control">             
            </div>
              <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-success" id="" onclick="EnviarCsv()">Importar</button>
              </div>
            </form>
          </div>
        </div>
      </div>
  </div>
@extends('backend.menus.footerjs')
@section('archivos-js')

    <script src="{{ asset('js/jquery.dataTables.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/dataTables.bootstrap4.js') }}" type="text/javascript"></script>

    <script src="{{ asset('js/toastr.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/axios.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/sweetalert2.all.min.js') }}"></script>
    <script src="{{ asset('js/alertaPersonalizada.js') }}"></script>
    <script src="{{ asset('js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('js/responsive.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('js/buttons.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('js/jszip.min.js') }}"></script>
    <script src="{{ asset('js/buttons.html5.min.js') }}"></script>

  <script>
//*********************** Para darle tiempo al toaster al recargar la pagina */
toastr.options.timeOut = 1500;
    toastr.options.fadeOut = 1500;
    toastr.options.onHidden = function(){
      // this will be executed after fadeout, i.e. 2secs after notification has been show
     window.location.reload();
    }; 
//************************************************************************** */
// abre el modal para agregar Ret de Empleado
function abrirModalAgregarRet(id){
  document.getElementById("formularior").reset();   
  openLoading();// mostrar loading
  axios.post(url+'empleado/get_empleado_ret',{'id': id })
      .then((response) => {	
        closeLoading(); // cerrar loading
        if(response.data.success = 1){
          $('#ModalAgregarRet').modal('show');
          $('#idUr').val(response.data.empleado.id);
          $('#nombrer').val(response.data.empleado.nombre);    
          $('#duir').val(response.data.empleado.dui);   
        }else{ 
          toastr.error('Error', 'Empleado no encontrado'); 
        }
      })
      .catch((error) => {
        closeLoading(); // cerrar loading
        toastr.error('Error');    
  });
}

 // Agregar Retencion
 function enviarModalRet(){
            var codigoret_id = document.getElementById('codigoret_id').value;
            var fecharet = document.getElementById('fecharet').value;
            var montodevengado = parseFloat(document.getElementById('sueldo').value) + parseFloat(document.getElementById('vacaciones').value) + parseFloat(document.getElementById('horasextra').value) + parseFloat(document.getElementById('incapacidades').value) + parseFloat(document.getElementById('otrosingresos').value);
            var devengadobono;
            var impuestoret = document.getElementById('impuestoret').value;
            var aguinaldoexen = document.getElementById('aguinaldoexen').value;
            var aguinaldograv = document.getElementById('aguinaldograv').value;
            var afp = parseFloat(document.getElementById('confia').value) + parseFloat(document.getElementById('crecer').value);
            var isss = document.getElementById('isss').value;
            var inpep = document.getElementById('inpep').value;
            var ipsfa = document.getElementById('ipsfa').value;
            var cefafa;
            var bienmagis;
            var isssivm;
            var id = document.getElementById('idUr').value;

   
            openLoading();// mostrar loading
            
      let formData = new FormData();
      formData.append('codigoret_id', codigoret_id);
      formData.append('fecharet', fecharet);
      formData.append('montodevengado', montodevengado);
      formData.append('devengadobono', devengadobono);
      formData.append('impuestoret', impuestoret);
      formData.append('aguinaldoexen', aguinaldoexen);
      formData.append('aguinaldograv', aguinaldograv);
      formData.append('afp', afp);
      formData.append('isss', isss);
      formData.append('inpep', inpep);
      formData.append('ipsfa', ipsfa);
      formData.append('cefafa', cefafa);
      formData.append('bienmagis', bienmagis);
      formData.append('isssivm', isssivm);
      formData.append('id', id);
      

      axios.post(url+'empleado/registroret_emp', formData, {  
       })
       .then((response) => {	
        closeLoading(); // cerrar loading         
        mensajeResponse3(response);
       })
       .catch((error) => {  
        closeLoading(); // cerrar loadingo
          toastr.error('Error', 'Datos incorrectos!');               
      }); 
}

// Agregar Retencion General del Listado *********************************************
function enviarTablaRet(){
    let formData = new FormData();
    
            var fecharetl = document.getElementById('fecharetl').value;

            //var codigoret_id = $("input[name='codigoret_idl[]']").map(function(){return $(this).val();}).get();


            var montodevengadol = $("input[name='montodevengadol[]']").map(function(){return $(this).val();}).get();
            var devengadobonol = $("input[name='devengadobonol[]']").map(function(){return $(this).val();}).get();
            var impuestoretl = $("input[name='impuestoretl[]']").map(function(){return $(this).val();}).get();
            var aguinaldoexenl = $("input[name='aguinaldoexenl[]']").map(function(){return $(this).val();}).get();
            var aguinaldogravl = $("input[name='aguinaldogravl[]']").map(function(){return $(this).val();}).get();
            var afpl = $("input[name='afpl[]']").map(function(){return $(this).val();}).get();
            var isssl = $("input[name='isssl[]']").map(function(){return $(this).val();}).get();
            var inpepl = $("input[name='inpepl[]']").map(function(){return $(this).val();}).get();
            var ipsfal = $("input[name='ipsfal[]']").map(function(){return $(this).val();}).get();
            var cefafal = $("input[name='cefafal[]']").map(function(){return $(this).val();}).get();
            var bienmagisl = $("input[name='bienmagisl[]']").map(function(){return $(this).val();}).get();
            var isssivml = $("input[name='isssivml[]']").map(function(){return $(this).val();}).get();
            var id = $("input[name='idUl[]']").map(function(){return $(this).val();}).get();
        
       

        // como tienen la misma cantidad de filas, podemos recorrer
        // todas las filas de una vez
       console.log(codigoret_id);
        for(var p = 0; p < id.length; p++){
            
            formData.append('empleado_id[]', id[p]);
            //formData.append('codigoret_id[]', codigoret_id[p]);
            formData.append('montodevengado[]', montodevengadol[p]);
            formData.append('devengadobono[]', devengadobonol[p]);
            formData.append('impuestoret[]', impuestoretl[p]);
            formData.append('aguinaldoexen[]', aguinaldoexenl[p]);
            formData.append('aguinaldograv[]', aguinaldogravl[p]);
            formData.append('afp[]', afpl[p]);
            formData.append('isss[]', isssl[p]);
            formData.append('inpep[]', inpepl[p]);
            formData.append('ipsfa[]', ipsfal[p]);
            formData.append('cefafa[]', cefafal[p]);
            formData.append('bienmagis[]', bienmagisl[p]);
            formData.append('isssivm[]', isssivml[p]);
            
        }   
        //obtenemos el select
        var row = $('#example23').find('tr');
        $(row).each(function (index, element) {
          var codigoret_idl = $(this).find('.seleccion').val();

          if(codigoret_idl !== undefined && codigoret_idl !== null){
            formData.append('codigoret_id[]', codigoret_idl);
          }
        });

      openLoading();      
      formData.append('fecharet', fecharetl);

      axios.post(url+'empleado/registrolistret_emp', formData, {  
       })
       .then((response) => {	
        closeLoading(); // cerrar loading         
        mensajeResponse5(response);
       })
       .catch((error) => {  
        closeLoading(); // cerrar loadingo
          toastr.error('Error', 'Datos incorrectos!');               
      }); 
}
//************************************************************************ */

// abre el modal para editar un empleado
function abrirModalEditar(id){
  document.getElementById("formularioU").reset();   
  openLoading();// mostrar loading
  axios.post(url+'empleado/get_empleado',{'id': id })
      .then((response) => {	
        closeLoading(); // cerrar loading
        if(response.data.success = 1){
          $('#modalEditar').modal('show');
          $('#idU').val(response.data.empleado.id);
          $('#codigopais_id').val(response.data.empleado.codigopais_id);    
          $('#nombre').val(response.data.empleado.nombre); 
          $('#apellido').val(response.data.empleado.apellido);    
          $('#nit').val(response.data.empleado.nit); 
          $('#dui').val(response.data.empleado.dui);   
          $('#domiciliado').val(response.data.empleado.domiciliado);   
        }else{ 
          toastr.error('Error', 'Empleado no encontrado'); 
        }
      })
      .catch((error) => {
        closeLoading(); // cerrar loading
        toastr.error('Error');    
  });
}

function abrirModalAgregar(){
    document.getElementById("formularion").reset();   
    $('#modalAgregar').modal('show');   
}
function abrirModalcsv(){
    $('#modalcsv').modal('show');   
}
  // Abrir modal para subir el archivo y mandarlo, ademas, recibir la informacion de respuesta.
  function EnviarCsv(){
      //var file = document.getElementById('file');
       openLoading();// mostrar loading

      var formData = new FormData($('.form')[0]);
      axios.post(url+'empleado/import', formData, {  
       })
       .then((response) => {
                    
                    if(response.data.success === 1){
                      closeLoading();
                      //toastr.success('Cargado', 'El archivo CSV se ha cargado con Exito!');
                      $('#modalcsv').modal('hide'); 
                      var listadatos = response.data.lista;
                      for (var i = 0; i < listadatos.length; i++) {
                          if(parseFloat(listadatos[i].aguinaldo) > 1300){
                            $aguinaldoexen2 = 1300;
                            $aguinaldograv2 = parseFloat(listadatos[i].aguinaldo) - 1300;
                          }else{
                            $aguinaldoexen2 = parseFloat(listadatos[i].aguinaldo);
                            $aguinaldograv2 = 0;
                          }
                          if(parseFloat(listadatos[i].afpconfia) === 0){
                            $afp2 = parseFloat(listadatos[i].afpcrecer);
                          }else{
                            $afp2 = parseFloat(listadatos[i].afpconfia);
                          }
                          
                          $devengadototal = parseFloat(listadatos[i].sueldo) + parseFloat(listadatos[i].vacaciones) + parseFloat(listadatos[i].horasextra) + parseFloat(listadatos[i].incapacidad);
                        var markup =  "<tr>"+
                                        "<td>"+
                                        "<input name='nombrel[]' value='"+listadatos[i].nombre+"' class='form-control' type='text'>"+
                                        "<input name='idUl[]' value='"+listadatos[i].empleado_id+"' type='hidden'>"+
                                        "</td>"+
                                        "<td>"+
                                        "<select class='form-control seleccion' name='codigoret_idl[]'>"+
                                        "@foreach($codigoret as $sel)"+
                                        "<option value='{{ $sel->id }}'>{{ $sel->nombre }}</option>"+
                                        "@endforeach>"+
                                        "</select>"+
                                        "</td>"+
                                        "<td>"+
                                        "<input name='montodevengadol[]' value='"+$devengadototal+"' class='form-control'  step='any' type='number'>"+
                                        "</td>"+
                                        "<td>"+
                                        "<input name='devengadobonol[]' value='0' class='form-control' step='any' type='number'>"+
                                        "</td>"+
                                        "<td>"+
                                        "<input name='impuestoretl[]' value='"+listadatos[i].impuestoret+"' class='form-control'  step='any' type='number'>"+
                                        "</td>"+
                                        "<td>"+
                                        "<input name='aguinaldoexenl[]' value='"+$aguinaldoexen2+"' class='form-control'  step='any' type='number'>"+
                                        "</td>"+
                                        "<td>"+
                                        "<input name='aguinaldogravl[]' value='"+$aguinaldograv2+"' class='form-control'  step='any' type='number'>"+
                                        "</td>"+
                                        "<td>"+
                                        "<input name='afpl[]' value='"+$afp2+"' class='form-control'  step='any' type='number'>"+
                                        "</td>"+
                                        "<td>"+
                                        "<input name='isssl[]' value='"+listadatos[i].isss+"' class='form-control'  step='any' type='number'>"+
                                        "</td>"+
                                        "<td>"+
                                        "<input name='inpepl[]' value='"+listadatos[i].inpep+"' class='form-control'  step='any' type='number'>"+
                                        "</td>"+
                                        "<td>"+
                                        "<input name='ipsfal[]' value='"+listadatos[i].ipsfa+"' class='form-control'  step='any' type='number'>"+
                                        "</td>"+
                                        "<td>"+
                                        "<input name='cefafal[]' value='0' class='form-control'  step='any' type='number'>"+
                                        "</td>"+
                                        "<td>"+
                                        "<input name='isssivml[]' value='0' class='form-control'  step='any' type='number'>"+
                                        "</td>"+
                                        "<td>"+
                                        "<input name='bienmagisl[]' value='0' class='form-control'  step='any' type='number'>"+
                                        "</td>"+

                                        "</tr>";
                                        $("#example23 tbody").append(markup);
                        }

                        //$('#ModalguardarlistaRet').css('overflow-y', 'auto');
                        //$('#ModalguardarlistaRet').modal({backdrop: 'static', keyboard: false})
                        $('#ModalguardarlistaRet').modal('show');

                    }
                      else{
                         closeLoading(); // cerrar loading        
                         mensajeResponse4(response);
                    }
                })
       .catch((error) => {  
          closeLoading(); // cerrar loading  
          toastr.error('Error', 'Datos incorrectos!');          
      }); 
}

    // Actualizar Empleado
function enviarModalEditar(){
  var codigopais_id = document.getElementById('codigopais_id').value;
          var nombre = document.getElementById('nombre').value;
          var apellido = document.getElementById('apellido').value;
            var nit = document.getElementById('nit').value;
            var dui = document.getElementById('dui').value;
            var domiciliado = document.getElementById('domiciliado').value;
            var id = document.getElementById('idU').value;

   
            openLoading();// mostrar loading
            
      let formData = new FormData();
      formData.append('codigopais_id', codigopais_id);
      formData.append('nombre', nombre);
      formData.append('apellido', apellido);
      formData.append('nit', nit);
      formData.append('dui', dui);
      formData.append('id', id);
      formData.append('domiciliado', domiciliado);
      

      axios.post(url+'empleado/update_empleado', formData, {  
       })
       .then((response) => {	
        closeLoading(); // cerrar loading         
        mensajeResponse2(response);
       })
       .catch((error) => {  
        closeLoading(); // cerrar loadingo
          toastr.error('Error', 'Datos incorrectos!');               
      }); 
}

    // guardar nuevo Empleado
    function enviarModalAgregar(){
            var codigopais_id = document.getElementById('codigopais_idn').value;
            var nombre = document.getElementById('nombren').value;
            var apellido = document.getElementById('apellidon').value;
            var nit = document.getElementById('nitn').value;
            var dui = document.getElementById('duin').value;
            var domiciliado = document.getElementById('domiciliadon').value;

   
            openLoading();// mostrar loading
            
      let formData = new FormData();
      formData.append('codigopais_id', codigopais_id);
      formData.append('nombre', nombre);
      formData.append('apellido', apellido);
      formData.append('nit', nit);
      formData.append('dui', dui);
      formData.append('domiciliado', domiciliado);

      axios.post(url+'empleado/add_empleado', formData, {  
       })
       .then((response) => {	
        closeLoading(); // cerrar loading        
        mensajeResponse1(response);
       })
       .catch((error) => {  
        closeLoading(); // cerrar loading  
          toastr.error('Error', 'Datos incorrectos!');               
      }); 
}

// mensaje cuando actualiza un Empleado
function mensajeResponse2(valor){
  if(valor.data.success == 1){
    toastr.success('Guardado', 'Se han guardado los cambios en el registro del Empleado!');
    $('#modalEditar').modal('hide'); 
  }else if(valor.data.success == 2){
    toastr.error('Error', 'Empleado no se pudo actualizar!');
  }else{
    // error en validacion en servidor
    toastr.error('Error', 'Datos incorrectos!');
  }
}
// mensaje cuando registra un listado de retencion
function mensajeResponse4(valor){
  if(valor.data.success == 2){
    toastr.error('Error', 'En la lista hay un empleado no registrado y es el dui: '+valor.data.dui);
  }else if(valor.data.success == 3){
    // error en validacion en servidor
    toastr.error('Error', 'Un dui no coincide con el nombre de la persona, el dui es '+valor.data.dui);
  }
}


// mensaje cuando registra retencion
function mensajeResponse3(valor){
  if(valor.data.success == 1){
    toastr.success('Guardado', 'La Retencion se registro con Exito!');
    $('#ModalAgregarRet').modal('hide'); 
  }else if(valor.data.success == 2){
    toastr.error('Error', 'No se pudo registrar la retencion!');
  }else{
    // error en validacion en servidor
    toastr.error('Error', 'Datos incorrectos!');
  }
}
// mensaje cuando registra un listado de  retencion
function mensajeResponse5(valor){
  if(valor.data.success == 1){
    toastr.success('Guardado', 'La lista de Retencion se registro con Exito!');
    $('#ModalguardarlistaRet').modal('hide'); 
  }else if(valor.data.success == 2){
    toastr.error('Error', 'No se pudo registrar las retenciones!');
  }else{
    // error en validacion en servidor
    toastr.error('Error', 'Datos incorrectos!');
  }
}
// mensaje cuando se registra un nuevo Empleado
function mensajeResponse1(valor){
  if(valor.data.success == 1){
    toastr.success('Guardado', 'Se ha guardado el nuevo Empleado!');
    $('#modalAgregar').modal('hide'); 
  }else if(valor.data.success == 2){
    toastr.error('Error', 'Empleado NO Registrado!');
  }else{
    // error en validacion en servidor
    toastr.error('Error', 'Datos incorrectos!');
  }
}

// abre el modal para eliminar un Empleado
function abrirModalEliminar(id){     
  $('#modalEliminar').modal('show');
  $('#idD').val(id);    
}

// enviar peticion para borrar  un Empleado
function borrarempleado(){
  id = document.getElementById("idD").value;
  openLoading();// mostrar loading

  axios.post(url+'empleado/delete_empleado',{
    'id': id  
      })
      .then((response) => {	
        closeLoading(); // cerrar loading

        if(response.data.success == 1){
          toastr.success('Empleado Eliminado!')
          $('#modalEliminar').modal('hide');   
        }else{
          toastr.error('Error', 'No se pudo eliminar el empleado');  
        }           
      })
      .catch((error) => {
        closeLoading(); // cerrar loading 
        toastr.error('Error');               
  });
}

    //Select con buscardor (select2)
    jQuery(document).ready(function($){
            $('.codigopais_id').select2();
            $('.codigopais_idn').select2();
            $('.codigoret_id').select2();
            $('.domiciliado').select2();
            $('.domiciliadon').select2();
    });



</script>

<script type="text/javascript">
//Script para Organizar la tabla de datos
    $(document).ready(function() {
      $('#example2').DataTable({
        "paging": true,
        "lengthChange": true,
        "searching": true,
        "order": [[ 2, "desc" ]],
        "info": true,
        "autoWidth": false,
        "language": {
        "info": "Mostrando _START_ a _END_ de _TOTAL_ entradas"            
        }
      });
    });
</script>

@stop