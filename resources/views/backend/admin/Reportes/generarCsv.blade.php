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
              <h1>GENERAR CSV</h1>
            </div>
          </div>
        </div>
  </section>
    <!-- seccion frame -->
  <section class="content">
    <div class="container-fluid">
        <div class="card card-light ">
          <div class="card-header">
            <h3 class="card-title">Generar Reporte</h3>

            <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
              <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-remove"></i></button>
            </div>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <div class="row">
              <div class="col-md-12">
              <form id="formularior">
                <div class="card-body">
                  <div class="row">  
                    <div class="col-md-4"> 
                      <div class="form-group">
                            <label>Mes:</label>   
                            <input type="month" class="form-control" id="fecha" name="fecha" min="2015-01" >
                      </div>
                    </div>
                  </div> 
                </div> 
                <div class="card-footer">
                  <span data-href="/tasks" id="export" class="btn btn-success float-right" onclick="exportTasks();">Generar</span>
                </div> 
              </form>
             </div>
            </div>          
          </div>
       </div>
      </div>
    </section>

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




    // guardar nuevo codigoret
    function enviarModalAgregar(){
            var nombre = document.getElementById('nombren').value;
            var codigo = document.getElementById('codigon').value;
   
            openLoading(); // activar loading
            
      let formData = new FormData();
      formData.append('nombre', nombre);
      formData.append('codigo', codigo);

      axios.post(url+'codigoret/add_codigoret', formData, {  
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

// mensaje cuando actualiza un codigoret
function mensajeResponse2(valor){
  if(valor.data.success == 1){
    toastr.success('Guardado', 'Se han guardado los cambios en el registro!');
    $('#modalEditar').modal('hide'); 
  }else if(valor.data.error == 2){
    toastr.error('Error', 'No se pudo actualizar!');
  }else{
    // error en validacion en servidor
    toastr.error('Error', 'Datos incorrectos!');
  }
}
</script>
<script>
   function exportTasks() {
      var fecha = document.getElementById('fecha').value;
      window.location.href = "{{url('/admin/tarea')}}/"+fecha;
   }
</script>
@stop