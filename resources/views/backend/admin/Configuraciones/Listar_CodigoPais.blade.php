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
              <h1>Registro de Códigos de País</h1>
            </div>
            <div class="col-sm-2">
              <button type="button" onclick="abrirModalAgregar()" class="btn btn-info btn-sm">
              <i class="fas fa-pencil-alt"></i>
              Agregar
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
            <h3 class="card-title">Código de País</h3>

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
                  <th style="width: 35%;">País</th>
                  <th style="width: 35%;">Código</th>                      
                  <th style="width: 25%;">Acciones</th>                           
                </tr>
                </thead>
                <tbody>
                @foreach($codigopais as $dato)
                <tr>
                  <td>{{ $dato->nombre }}</td>
                  <td>{{ $dato->codigo }}</td>      
                  <td>
                  <button type="button" class="btn btn-info btn-xs" onclick="abrirModalEditar({{ $dato->id }})">
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
	
<!-- modal Agregar codigo de pais -->
<div class="modal fade" id="modalAgregar">
        <div class="modal-dialog modal-xl">
          <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title">Agregar nuevo Código de País</h4>
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
                        <label>Nombre de país:</label>   
                        <input type="text" class="form-control" id="nombren" name="nombren" placeholder="Nombre">
                    </div>    
                    <div class="form-group">
                        <label>Código:</label>   
                        <input type="text" class="form-control" id="codigon" name="codigon" placeholder="Código de País">
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

   <!-- modal editar codigo de pais -->
   <div class="modal fade" id="modalEditar">
        <div class="modal-dialog modal-xl">
          <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title">Editar Código de País</h4>
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
                        <label>Nombre de país:</label>   
                        <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Nombre">
                        <input type="hidden" id="idU"  name="idU"/>   
                    </div>   
                    <div class="form-group">
                        <label>Código de país</label>   
                        <input type="text" class="form-control" id="codigo" name="codigo" placeholder="codigo">  
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
              <h4 class="modal-title">Eliminar un código de país</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
              </button>
            </div>
                  <div class="modal-body">
                    <input type="hidden" id="idD" name="idD"/> <!-- id del codigo de pais para borrarlo -->                           
                  </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>             
              <button class="btn btn-danger" id="btnBorrar" type="button" onclick="borrarcodigopais()">Borrar</button>
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
// abre el modal para editar un codigo de pais
function abrirModalEditar(id){
  document.getElementById("formularioU").reset();   
  openLoading();
  axios.post(url+'codigopais/get_codigopais',{'id': id })
      .then((response) => {	
        closeLoading(); // cerrar loading
        if(response.data.success = 1){
          $('#modalEditar').modal('show');
          $('#idU').val(response.data.codigopais.id);
          $('#nombre').val(response.data.codigopais.nombre);    
          $('#codigo').val(response.data.codigopais.codigo);    
        }else{ 
          toastr.error('Error', 'Codigo de pais no encontrado'); 
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

    // Actualizar codigo de pais
function enviarModalEditar(){  
          var nombre = document.getElementById('nombre').value;
          var codigo = document.getElementById('codigo').value;
            var id = document.getElementById('idU').value;

   
            openLoading(); // activar loading
            
      let formData = new FormData();
      formData.append('nombre', nombre);
      formData.append('codigo', codigo);
      formData.append('id', id);
      

      axios.post(url+'codigopais/update_codigopais', formData, {  
       })
       .then((response) => {	
        closeLoading(); // cerrar loading            
        mensajeResponse2(response);
       })
       .catch((error) => {  
        closeLoading(); // cerrar loading   
          toastr.error('Error', 'Datos incorrectos!');               
      }); 
}

    // guardar nuevo codigopais
    function enviarModalAgregar(){
            var nombre = document.getElementById('nombren').value;
            var codigo = document.getElementById('codigon').value;
   
            openLoading(); // activar loading
            
      let formData = new FormData();
      formData.append('nombre', nombre);
      formData.append('codigo', codigo);

      axios.post(url+'codigopais/add_codigopais', formData, {  
       })
       .then((response) => {	
        closeLoading();// cerrar loading            
        mensajeResponse1(response);
       })
       .catch((error) => {  
        closeLoading(); // cerrar loading   
          toastr.error('Error', 'Datos incorrectos!');               
      }); 
}

// mensaje cuando actualiza un codigopais
function mensajeResponse2(valor){
  if(valor.data.success == 1){
    toastr.success('Guardado', 'Se han guardado los cambios en el registro!');
    $('#modalEditar').modal('hide'); 
  }else if(valor.data.success == 2){
    toastr.error('Error', 'No se pudo actualizar!');
  }else{
    // error en validacion en servidor
    toastr.error('Error', 'Datos incorrectos!');
  }
}
// mensaje cuando se registra un codigopais
function mensajeResponse1(valor){
  if(valor.data.success == 1){
    toastr.success('Guardado', 'Se ha guardado el nuevo Codigo de pais!');
    $('#modalAgregar').modal('hide'); 
  }else if(valor.data.success == 2){
    toastr.error('Error', 'Codigo de pais NO Registrado!');
  }else{
    // error en validacion en servidor
    toastr.error('Error', 'Datos incorrectos!');
  }
}

// abre el modal para eliminar un codigo
function abrirModalEliminar(id){     
  $('#modalEliminar').modal('show');
  $('#idD').val(id);    
}

// enviar peticion para borrar  un proveedor
function borrarcodigopais(){
  id = document.getElementById("idD").value;
  openLoading();// mostrar loading

  axios.post(url+'codigopais/delete_codigopais',{
    'id': id  
      })
      .then((response) => {	
        closeLoading(); // cerrar loading

        if(response.data.success == 1){
          toastr.success('Codigo de Pais Eliminado!')
          $('#modalEliminar').modal('hide');   
        }else{
          toastr.error('Error', 'No se pudo eliminar el Codigo de pais');  
        }           
      })
      .catch((error) => {
        closeLoading(); // cerrar loading   
        toastr.error('Error');               
  });
}
</script>

<script type="text/javascript">
//Script para Organizar la tabla de datos
    $(document).ready(function() {
      $('#example2').DataTable({
        "paging": true,
        "lengthChange": true,
        "searching": true,
        "order": [[ 0, "desc" ]],
        "info": true,
        "autoWidth": false,
        "language": {
        "info": "Mostrando _START_ a _END_ de _TOTAL_ entradas"            
        }
      });
    });
</script>

@stop