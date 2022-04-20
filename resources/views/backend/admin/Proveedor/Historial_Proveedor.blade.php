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
              <h1>Historial de <strong>{{$proveedor->nombre }}</strong></h1>
            </div>
            <div class="col-sm-2">
              
          </div>
          </div>
        </div>
  </section>
    <!-- seccion frame -->
  <section class="content">
    <div class="container-fluid">
        <div class="card card-light ">
          <div class="card-header">
            <h3 class="card-title">Historico de Retenciones</h3>

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
                  <th style="width: 20%;">Fecha de Retención</th>
                  <th style="width: 20%;">Num. Factura</th>                      
                  <th style="width: 20%;">Monto</th>  
                  <th style="width: 15%;">Monto de Retención</th>                      
                  <th style="width: 25%;">Acciones</th>                           
                </tr>
                </thead>
                <tbody>
                @foreach($historial as $dato)
                <tr>
                  <td>{{ $dato->fecharet }}</td>
                  <td># {{ $dato->numfactura }}</td>
                  <td>$ {{ $dato->monto }}</td>
                  <td>$ {{ $dato->montoret }}</td>      
                  <td>
                  <button type="button" class="btn btn-info btn-xs" onclick="abrirModalEditRet({{ $dato->id }})">
                    <i class="fas fa-pencil-alt" title="Editar"></i>&nbsp; Editar
                    </button>
                    <button type="button" class="btn btn-danger btn-xs" onclick="abrirModalEliminar({{ $dato->id }})">
                    <i class="fas fa-trash-alt" title="Eliminar"></i>&nbsp; Eliminar
                    </button>
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

<!-- modal Editar Retencion de Proveedor -->
<div class="modal fade" id="ModalEditarRet">
        <div class="modal-dialog modal-xl">
          <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title">Editar Registro de Retención</h4>
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
                          <input type="hidden" id="idU"  name="idU"/>   
                          <input type="text" class="form-control" id="nit" name="nit" value="{{$proveedor->nit}}" readonly placeholder="Número de Identificación Tributaria">
                    </div>
                  </div>  
                  <div class="col-md-6">
                    <div class="form-group">
                          <label>Nombre:</label>   
                          <input type="text" class="form-control" id="nombre" name="nombre" value="{{$proveedor->nombre}}" readonly placeholder="Nombre">
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
                  <div class="col-md-5">
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
            <button type="button" class="btn btn-primary" id="btnGuardarU" onclick="enviarModalEditRet()">Guardar</button>
          </div>          
        </div>        
      </div>      
    </div>

     <!-- modal eliminar -->
  <div class="modal fade" id="modalEliminar">
      <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Eliminar Calculo de Retención</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
              </button>
            </div>
                  <div class="modal-body">
                    <input type="hidden" id="idD" name="idD"/> <!-- id del calculo para borrarlo -->                           
                  </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>             
              <button class="btn btn-danger" id="btnBorrar" type="button" onclick="borrarcalculopro()">Borrar</button>
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

// abre el modal para Editar Ret de Proveedor
function abrirModalEditRet(id){
  document.getElementById("formularior").reset();   
  openLoading();// mostrar loading
  axios.post(url+'proveedor/get_historial_pro',{'id': id })
      .then((response) => {	
        closeLoading(); // cerrar loading
        if(response.data.success = 1){
          $('#ModalEditarRet').modal('show');
          $('#idU').val(response.data.historial.id);
          $('#fecharet').val(response.data.historial.fecharet); 
          $('#partida').val(response.data.historial.partida);  
          $('#codigoret_id').val(response.data.historial.codigoret_id);  
          $('#arrendamiento').val(response.data.historial.arrendamiento);  
          $('#numfactura').val(response.data.historial.numfactura);  
          $('#monto').val(response.data.historial.monto);   
          $('#montoret').val(response.data.historial.montoret);   
        }else{ 
          toastr.error('Error', 'Retencion de Proveedor no encontrado'); 
        }
      })
      .catch((error) => {
        closeLoading(); // cerrar loading
        toastr.error("error");    
  });
}
    // Editar  Retencion
    function enviarModalEditRet(){
  var codigoret_id = document.getElementById('codigoret_id').value;
          var fecharet = document.getElementById('fecharet').value;
            var partida = document.getElementById('partida').value;
            var arrendamiento = document.getElementById('arrendamiento').value;
            var numfactura = document.getElementById('numfactura').value;
            var monto = document.getElementById('monto').value;
            var montoret = document.getElementById('montoret').value;
            var id = document.getElementById('idU').value;

   
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
      

      axios.post(url+'proveedor/update_registroret', formData, {  
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

// abre el modal para eliminar una fuente de recursos
function abrirModalEliminar(id){     
  $('#modalEliminar').modal('show');
  $('#idD').val(id);    
}

// enviar peticion para borrar un registro de retencion
function borrarcalculopro(){
  id = document.getElementById("idD").value;
  openLoading();// mostrar loading

  axios.post(url+'proveedor/delete_registroret',{
    'id': id  
      })
      .then((response) => {	
        closeLoading(); // cerrar loading

        if(response.data.success == 1){
          toastr.success('Calculo de retencion Eliminado!')
          $('#modalEliminar').modal('hide');   
        }else{
          toastr.error('Error', 'No se pudo eliminar el calculo de retencion');  
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
            $('.codigoret_id').select2();
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