@extends('backend.menus.superior')

@section('content-admin-css')
    <link href="{{ asset('css/adminlte.min.css') }}" type="text/css" rel="stylesheet" />
    <link href="{{ asset('css/dataTables.bootstrap4.css') }}" type="text/css" rel="stylesheet" />
    <link href="{{ asset('css/toastr.min.css') }}" type="text/css" rel="stylesheet" />
    <link href="{{ asset('css/responsive.bootstrap4.min.css') }}" type="text/css" rel="stylesheet" />
    <link href="{{ asset('css/buttons.bootstrap4.min.css') }}" type="text/css" rel="stylesheet" />
    <link href="{{ asset('css/estiloToggle.css') }}" type="text/css" rel="stylesheet" />
@stop
  <section class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1>Registro de Proveedores</h1>
            </div>
            <div class="col-sm-2">
              <button type="button" onclick="abrirModalAgregar()" class="btn btn-info btn-sm">
              <i class="fas fa-pencil-alt"></i>
              Agregar Proveedor
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
            <h3 class="card-title">Proveedores</h3>

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
                  <th style="width: 20%;">NIT</th>
                  <th style="width: 20%;">DUI</th>
                  <th style="width: 35%;">Nombre</th>                      
                  <th style="width: 25%;">Acciones</th>                           
                </tr>
                </thead>
                <tbody>
                @foreach($proveedores as $dato)
                <tr>
                  <td>{{ $dato->nit }}</td>
                  <td>{{ $dato->dui }}</td>
                  <td>{{ $dato->nombre }}</td>      
                  <td>
                  <button type="button" class="btn btn-success btn-xs" onclick="abrirModalAgregarRet({{ $dato->id }})">
                    <i class="fas fa-pencil-alt" title="Agregar Datos"></i>&nbsp; Agregar Datos
                    </button>

                  <button type="button" class="btn btn-info btn-xs" onclick="abrirModalEditar({{ $dato->id }})">
                    <i class="fas fa-pencil-alt" title="Editar"></i>&nbsp; Editar
                    </button>

                    <button type="button" class="btn btn-danger btn-xs" onclick="abrirModalEliminar({{ $dato->id }})">
                    <i class="fas fa-trash-alt" title="Eliminar"></i>&nbsp; Eliminar
                    </button>
                    <a class="btn btn-primary btn-xs" href="{{ url('admin/proveedor/historial_ret/'.$dato->id ) }}" target="frameprincipal">
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
	
<!-- modal Agregar Proveedor -->
<div class="modal fade" id="modalAgregar">
        <div class="modal-dialog modal-xl">
          <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title">Agregar nuevo Proveedor</h4>
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
                          <label>NIT:</label>   
                          <input type="text" class="form-control" id="nitn" name="nitn" placeholder="Número de Identificación Tributaria">
                      </div>
                      <div class="form-group">
                          <label>DUI:</label>   
                          <input type="text" class="form-control" id="duin" name="duin" placeholder="Doumento Único de Identidad">
                      </div>
                    <div class="form-group">
                        <label>Nombre:</label>   
                        <input type="text" class="form-control" id="nombren" name="nombren" placeholder="Nombre">
                    </div>       
                    <div class="form-group">
                        <label>Tipo de Proveedor:</label>   
                        <select class="form-control tipopro_idn" id="tipopro_idn" name="tipopro_idn">
                          @foreach($tipopro as $sel)
                          <option value="{{ $sel->id }}">{{$sel->nombre}}</option>
                          @endforeach
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

<!-- modal Agregar Retencion de Proveedor -->
<div class="modal fade" id="ModalAgregarRet">
        <div class="modal-dialog modal-xl">
          <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title">Agregar Registro de Retención</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form id="formularior">
              <div class="card-body">
                <div class="row">  
                  <div class="col-md-4"> 
                    <div class="form-group">
                          <label>NIT:</label>   
                          <input type="hidden" id="idUr"  name="idUr"/>  
                          <input type="text" class="form-control" id="nitr" name="nitr" readonly placeholder="Número de Identificación Tributaria">
                    </div>
                  </div>  
                  <div class="col-md-6">
                    <div class="form-group">
                          <label>Nombre:</label>   
                          <input type="text" class="form-control" id="nombrer" name="nombrer" readonly placeholder="Nombre">
                    </div>
                  </div>
                </div> 
                <div class="row">  
                  <div class="col-md-4"> 
                    <div class="form-group">
                        <label>Fecha de Retención:</label>   
                        <input type="date" class="form-control" id="fecharet" name="fecharet" placeholder="Fecha de Retención">
                    </div>
                  </div>
                  <div class="col-md-4"> 
                    <div class="form-group">
                        <label># Partida:</label>   
                        <input type="text" class="form-control" id="partida" name="partida" placeholder="# Partida">
                    </div>     
                  </div> 
                </div>   
                <div class="row">  
                  <div class="col-md-4">
                    <div class="form-group">
                        <label>Código de Retención:</label>   
                        <select class="form-control codigoret_id" id="codigoret_id" name="codigoret_id">
                          @foreach($codigoret as $sel)
                          <option value="{{ $sel->id }}">{{$sel->nombre}}</option>
                          @endforeach
                        </select>
                    </div>
                  </div>
                  <div class="col-md-3">
                    <div class="form-group">
                        <label>Proveedor Arrendamiento:</label>   
                        <select class="form-control arrendamiento" id="arrendamiento" name="arrendamiento">
                          <option value="Si">SI</option>
                          <option value="No">NO</option>
                        </select>
                    </div> 
                  </div> 
                </div> 
                <div class="row">  
                  <div class="col-md-4">     
                    <div class="form-group">
                        <label>Número de Factura:</label>   
                        <input type="number" class="form-control"  step="any" id="numfactura" name="numfactura" placeholder="Numero de Factura">
                    </div>
                  </div>  
                  <div class="col-md-4">   
                    <div class="form-group">
                        <label>Monto:</label>   
                        <input type="number" class="form-control" step="any" id="monto" name="monto" placeholder="Monto de Factura">
                    </div> 
                  </div> 
                  <div class="col-md-4">   
                    <div class="form-group">
                        <label>Monto de Retención:</label>   
                        <input type="number" class="form-control"   step="any" id="montoret" name="montoret" placeholder="Monto de retencion">
                    </div> 
                  </div>
                </div> 
              </div>
            </form>
          </div>
          <div class="modal-footer justify-content-between">
            <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
            <button type="button" class="btn btn-primary" id="btnGuardarU" onclick="enviarModalRet()">Añadir</button>
          </div>          
        </div>        
      </div>      
    </div>
   
   <!-- modal editar Proveedor -->
   <div class="modal fade" id="modalEditar">
        <div class="modal-dialog modal-xl">
          <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title">Editar Proveedor</h4>
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
                          <label>NIT:</label>   
                          <input type="text" class="form-control" id="nit" name="nit" placeholder="Número de Identificación Tributaria">
                      </div>
                      <div class="form-group">
                          <label>DUI:</label>   
                          <input type="hidden" id="idU"  name="idU"/>   
                          <input type="text" class="form-control" id="dui" name="dui" placeholder="Doumento Único de Identidad">
                      </div>
                    <div class="form-group">
                        <label>Nombre:</label>   
                        <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Nombre">
                    </div>   
                    <div class="form-group">
                        <label>Tipo de Proveedor:</label>   
                        <select class="form-control tipopro_id" id="tipopro_id" name="tipopro_id">
                          @foreach($tipopro as $sel)
                          <option value="{{ $sel->id }}">{{$sel->nombre}}</option>
                          @endforeach
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
              <h4 class="modal-title">Eliminar Registro de Proveedor</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
              </button>
            </div>
                  <div class="modal-body">
                    <input type="hidden" id="idD" name="idD"/> <!-- id del proveedor para borrarlo -->                           
                  </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>             
              <button class="btn btn-danger" id="btnBorrar" type="button" onclick="borrarproveedor()">Borrar</button>
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

// abre el modal para editar un proveedor
function abrirModalEditar(id){
  document.getElementById("formularioU").reset();   
  openLoading();// mostrar loading
  axios.post(url+'proveedor/get_proveedor',{'id': id })
      .then((response) => {	
        closeLoading(); // cerrar loading
        if(response.data.success = 1){
          $('#modalEditar').modal('show');
          $('#idU').val(response.data.proveedor.id);              
          $('#nombre').val(response.data.proveedor.nombre);    
          $('#nit').val(response.data.proveedor.nit);   
          $('#dui').val(response.data.proveedor.dui);   
        }else{ 
          toastr.error('Error', 'Proveedor no encontrado'); 
        }
      })
      .catch((error) => {
        closeLoading(); // cerrar loading
        toastr.error('Error');    
  });
}

// abre el modal para agregar Ret de Proveedor
function abrirModalAgregarRet(id){
  document.getElementById("formularior").reset();   
  openLoading();// mostrar loading
  axios.post(url+'proveedor/get_proveedor_ret',{'id': id })
      .then((response) => {	
        closeLoading(); // cerrar loading
        if(response.data.success = 1){
          $('#ModalAgregarRet').modal('show');
          $('#idUr').val(response.data.proveedor.id);   
          $('#nombrer').val(response.data.proveedor.nombre);    
          $('#nitr').val(response.data.proveedor.nit);   
        }else{ 
          toastr.error('Error', 'Proveedor no encontrado'); 
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

    // Actualizar Proveedor
function enviarModalEditar(){
  var tipopro_id = document.getElementById('tipopro_id').value;
          var nombre = document.getElementById('nombre').value;
            var nit = document.getElementById('nit').value;
            var dui = document.getElementById('dui').value;
            var id = document.getElementById('idU').value;

   
            openLoading();// mostrar loading
            
      let formData = new FormData();
      formData.append('tipopro_id', tipopro_id);
      formData.append('nombre', nombre);
      formData.append('nit', nit);
      formData.append('dui', dui);
      formData.append('id', id);
      

      axios.post(url+'proveedor/update_proveedor', formData, {  
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
    // Agregar Retencion
    function enviarModalRet(){
  var codigoret_id = document.getElementById('codigoret_id').value;
          var fecharet = document.getElementById('fecharet').value;
            var partida = document.getElementById('partida').value;
            var arrendamiento = document.getElementById('arrendamiento').value;
            var numfactura = document.getElementById('numfactura').value;
            var monto = document.getElementById('monto').value;
            var montoret = document.getElementById('montoret').value;
            var id = document.getElementById('idUr').value;

   
            openLoading();// mostrar loading
            
      let formData = new FormData();
      formData.append('codigoret_id', codigoret_id);
      formData.append('fecharet', fecharet);
      formData.append('partida', partida);
      formData.append('arrendamiento', arrendamiento);
      formData.append('numfactura', numfactura);
      formData.append('monto', monto);
      formData.append('montoret', montoret);
      formData.append('id', id);
      

      axios.post(url+'proveedor/registroret_proveedor', formData, {  
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

    // guardar nuevo Proveedor
    function enviarModalAgregar(){
            var tipopro_id = document.getElementById('tipopro_idn').value;
            var nombre = document.getElementById('nombren').value;
            var nit = document.getElementById('nitn').value;
            var dui = document.getElementById('duin').value;

   
            openLoading();// mostrar loading
            
      let formData = new FormData();
      formData.append('tipopro_id', tipopro_id);
      formData.append('nombre', nombre);
      formData.append('nit', nit);
      formData.append('dui', dui);

      axios.post(url+'proveedor/add_proveedor', formData, {  
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

// mensaje cuando actualiza un proveedor
function mensajeResponse2(valor){
  if(valor.data.success == 1){
    toastr.success('Guardado', 'Se han guardado los cambios en el registro del Proveedor!');
    $('#modalEditar').modal('hide'); 
  }else if(valor.data.success == 2){
    toastr.error('Error', 'Proveedor no se pudo actualizar!');
  }else{
    // error en validacion en servidor
    toastr.error('Error', 'Datos incorrectos!');
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
// mensaje cuando se registra un nuevo proveedor
function mensajeResponse1(valor){
  if(valor.data.success == 1){
    toastr.success('Guardado', 'Se ha guardado el nuevo Proveedor!');
    $('#modalAgregar').modal('hide'); 
  }else if(valor.data.success == 2){
    toastr.error('Error', 'Proveedor NO Registrado!');
  }else{
    // error en validacion en servidor
    toastr.error('Error', 'Datos incorrectos!');
  }
}

// abre el modal para eliminar una fuente de recursos
function abrirModalEliminar(id){     
  $('#modalEliminar').modal('show');
  $('#idD').val(id);    
}

// enviar peticion para borrar  un proveedor
function borrarproveedor(){
  id = document.getElementById("idD").value;
  openLoading();// mostrar loading

  axios.post(url+'proveedor/delete_proveedor',{
    'id': id  
      })
      .then((response) => {	
        closeLoading(); // cerrar loading

        if(response.data.success == 1){
          toastr.success('Proveedor Eliminado!')
          $('#modalEliminar').modal('hide');   
        }else{
          toastr.error('Error', 'No se pudo eliminar el proveedor');  
        }           
      })
      .catch((error) => {
        closeLoading(); // cerrar loading 
        toastr.error('Error');               
  });
}

    //Select con buscardor (select2)
    jQuery(document).ready(function($){
            $('.tipopro_id').select2();
            $('.tipopro_idn').select2();
    });

</script>

<script type="text/javascript">
//Script para Organizar la tabla de datos
    $(document).ready(function() {
      $('#example2').DataTable({
        "paging": true,
        "lengthChange": true,
        "searching": true,
        "order": [[ 1, "desc" ]],
        "info": true,
        "autoWidth": false,
        "language": {
        "info": "Mostrando _START_ a _END_ de _TOTAL_ entradas"            
        }
      });
    });
</script>

@stop