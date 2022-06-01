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
              <h1>Historial de <strong>{{$empleado->nombre }} {{$empleado->apellido }}</strong></h1>
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
            <h3 class="card-title">Historico de Retenciones de Empleado</h3>

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
                  <th style="width: 15%;">Devengado</th>                      
                  <th style="width: 15%;">Impuesto Ret.</th>  
                  <th style="width: 15%;">AFP</th>
                  <th style="width: 15%;">ISSS</th>                      
                  <th style="width: 20%;">Acciones</th>                           
                </tr>
                </thead>
                <tbody>
                @foreach($historial as $dato)
                <tr>
                  <td>{{ $dato->fecharet }}</td>
                  <td>$ {{ $dato->montodevengado }}</td>
                  <td>$ {{ $dato->impuestoret }}</td>
                  <td>$ {{ $dato->afp }}</td>
                  <td>$ {{ $dato->isss }}</td>      
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

 <!-- modal Editar Retencion de empleado -->
 <div class="modal fade" id="ModalEditarRet">
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
                  <div class="col-md-4"> 
                    <div class="form-group">
                          <label>DUI:</label>   
                          <input type="hidden" id="idU"  name="idU"/>  
                          <input type="text" class="form-control" id="dui" name="dui" value="{{$empleado->dui}}" readonly >
                    </div>
                  </div>  
                  <div class="col-md-6">
                    <div class="form-group">
                          <label>Nombre:</label>   
                          <input type="text" class="form-control" id="nombrer" name="nombrer" value="{{$empleado->nombre}}" readonly>
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
                  <div class="col-md-5">
                    <div class="form-group">
                        <label>Código de Retención:</label>   <br>
                        <select class="form-control codigoret_id" id="codigoret_id" name="codigoret_id">
                          @foreach($codigoret as $sel)
                          <option value="{{ $sel->id }}">{{$sel->nombre}}</option>
                          @endforeach
                        </select>
                    </div>
                  </div>
                </div>   
                <div class="row">  
                <div class="col-md-4"> 
                    <div class="form-group">
                        <label>Devengado:</label>   
                        <input type="number" class="form-control" step="any" id="montodevengado" name="montodevengado" placeholder="Devengado">
                    </div>     
                  </div> 
                  <div class="col-md-4"> 
                    <div class="form-group">
                        <label>Devengado Bono:</label>   
                        <input type="number" class="form-control" step="any" id="devengadobono" name="devengadobono" placeholder="Devengado Bono">
                    </div>     
                  </div> 
                  <div class="col-md-4"> 
                    <div class="form-group">
                        <label>Impuesto Ret.:</label>   
                        <input type="number" class="form-control" step="any" id="impuestoret" name="impuestoret" placeholder="Impuesto Ret">
                    </div>     
                  </div> 
                </div> 
                <div class="row">  
                <div class="col-md-4"> 
                    <div class="form-group">
                        <label>Aguinaldo Exento:</label>   
                        <input type="number" class="form-control" step="any" id="aguinaldoexen" name="aguinaldoexeni" placeholder="Aguinaldo Exento">
                    </div>     
                  </div> 
                  <div class="col-md-4"> 
                    <div class="form-group">
                        <label>Aguinaldo Gravado:</label>   
                        <input type="number" class="form-control" step="any" id="aguinaldograv" name="aguinaldograv" placeholder="Aguinaldo Gravado">
                    </div>     
                  </div> 
                  <div class="col-md-4"> 
                    <div class="form-group">
                        <label>Bien Mag.:</label>   
                        <input type="number" class="form-control" step="any" id="bienmagis" name="bienmagis" placeholder="Bien Magisterial">
                    </div>     
                  </div> 
                </div> 
                <div class="row">  
                  <div class="col-md-4">     
                    <div class="form-group">
                        <label>AFP:</label>   
                        <input type="number" class="form-control"  step="any" id="afp" name="afp" placeholder="AFP">
                    </div>
                  </div>  
                  <div class="col-md-4">   
                    <div class="form-group">
                        <label>ISSS:</label>   
                        <input type="number" class="form-control" step="any" id="isss" name="isss" placeholder="ISSS">
                    </div> 
                  </div> 
                  <div class="col-md-4">   
                    <div class="form-group">
                        <label>INPEP:</label>   
                        <input type="number" class="form-control"   step="any" id="inpep" name="inpep" placeholder="INPEP">
                    </div> 
                  </div>
                </div> 
                <div class="row">  
                  <div class="col-md-4">     
                    <div class="form-group">
                        <label>IPSFA:</label>   
                        <input type="number" class="form-control"  step="any" id="ipsfa" name="ipsfa" placeholder="IPSFA">
                    </div>
                  </div>  
                  <div class="col-md-4">   
                    <div class="form-group">
                        <label>CEFAFA:</label>   
                        <input type="number" class="form-control" step="any" id="cefafa" name="cefafa" placeholder="CEFAFA">
                    </div> 
                  </div> 
                  <div class="col-md-4">   
                    <div class="form-group">
                        <label>ISSS ivm:</label>   
                        <input type="number" class="form-control"   step="any" id="isssivm" name="isssivm" placeholder="ISSS IVM">
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
              <button class="btn btn-danger" id="btnBorrar" type="button" onclick="borrarcalculoemp()">Borrar</button>
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

// abre el modal para Editar Ret de Empleado
function abrirModalEditRet(id){
  document.getElementById("formularior").reset();   
  openLoading();// mostrar loading
  axios.post(url+'empleado/get_historial_emp',{'id': id })
      .then((response) => {	
        closeLoading(); // cerrar loading
        if(response.data.success = 1){
          $('#ModalEditarRet').modal('show');
          $('#idU').val(response.data.historial.id);
          $('#fecharet').val(response.data.historial.fecharet); 
          $('#codigoret_id').val(response.data.historial.codigoret_id);  
          $('#montodevengado').val(response.data.historial.montodevengado);  
          $('#devengadobono').val(response.data.historial.devengadobono);  
          $('#impuestoret').val(response.data.historial.impuestoret);  
          $('#aguinaldoexen').val(response.data.historial.aguinaldoexen);  
          $('#aguinaldograv').val(response.data.historial.aguinaldograv);  
          $('#afp').val(response.data.historial.afp);  
          $('#isss').val(response.data.historial.isss);  
          $('#inpep').val(response.data.historial.inpep);  
          $('#ipsfa').val(response.data.historial.ipsfa);  
          $('#cefafa').val(response.data.historial.cefafa);   
          $('#bienmagis').val(response.data.historial.bienmagis);   
          $('#isssivm').val(response.data.historial.isssivm);   
        }else{ 
          toastr.error('Error', 'Retencion de Empleado no encontrado'); 
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
            var montodevengado = document.getElementById('montodevengado').value;
            var devengadobono = document.getElementById('devengadobono').value;
            var impuestoret = document.getElementById('impuestoret').value;
            var aguinaldoexen = document.getElementById('aguinaldoexen').value;
            var aguinaldograv = document.getElementById('aguinaldograv').value;
            var afp = document.getElementById('afp').value;
            var isss = document.getElementById('isss').value;
            var inpep = document.getElementById('inpep').value;
            var ipsfa = document.getElementById('ipsfa').value;
            var cefafa = document.getElementById('cefafa').value;
            var bienmagis = document.getElementById('bienmagis').value;
            var isssivm = document.getElementById('isssivm').value;
            var id = document.getElementById('idU').value;

   
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
      

      axios.post(url+'empleado/update_registroret', formData, {  
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

// enviar peticion para borrar  un empleado
function borrarcalculoemp(){
  id = document.getElementById("idD").value;
  openLoading();// mostrar loading

  axios.post(url+'empleado/delete_registroret',{
    'id': id  
      })
      .then((response) => {	
        closeLoading(); // cerrar loading

        if(response.data.success == 1){
          toastr.success('Registro de retencion Eliminado!')
          $('#modalEliminar').modal('hide');   
        }else{
          toastr.error('Error', 'No se pudo eliminar el registro de Retencion');  
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