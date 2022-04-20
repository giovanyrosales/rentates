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
            <h1>Editar Usuario</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Inicio</a></li>
              <li class="breadcrumb-item active">Editar Usuario</li>
            </ol>
          </div>
        </div>
      </div>
    </section>

    <section class="content">
      <div class="container-fluid">
        <!-- SELECT2 EXAMPLE -->
        <form class="form-horizontal" id="form1">
        <div class="card card-success">
          <div class="card-header">
            <h3 class="card-title">Formulario de datos de Usuario</h3>

            <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
              <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-remove"></i></button>
            </div>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <div class="row">
              <div class="col-md-6">
              <div class="form-group">
                        <label>Nombre:</label>
                        <input type="text" name="nombre" id="nombre" class="form-control" required placeholder="Nombre" value="{{ $usuario->nombre }}">
                        <input type="hidden" name="id" id="id" class="form-control" value="{{ $usuario->id  }}">
                      </div>
                <!-- /.form-group -->
                <div class="form-group">
                        <label>Usuario:</label>
                        <input type="text" name="usuario" id="usuario" required class="form-control" placeholder="Apellido" value="{{ $usuario->usuario }}">
                      </div>
                <!-- /.form-group -->
              
                <div class="form-group">
                    <label for="exampleInputPassword1">Contraseña:</label>
                    <input type="password" name="password2" id="password2" class="form-control"  value="">
                  </div>
                <!-- /.form-group -->    
                <div class="form-group">
                    <label for="exampleInputPassword1">Repetir Contraseña:</label>
                    <input type="password" name="password" id="password" class="form-control"  value="">
                  </div>
                <!-- /.form-group -->  
              </div>
              <!-- /.col -->
              <div class="col-md-6">
              <div class="form-group">
                        <label>Apellido:</label>
                        <input type="text" name="apellido" id="apellido" class="form-control" required placeholder="Apellido" value="{{ $usuario->apellido  }}">
                      </div>
                <!-- /.form-group -->
              </div>
            <!-- /.col -->
            </div>
          <!-- /.row -->
          </div>
         <!-- /.card-body -->
         <div class="card-footer">
                  <button type="button" class="btn btn-info float-right" onclick="actualizarUsuario();">Actualizar</button>
                  <button type="button" onclick="location.href='{{ url('/admin/inicio') }}'" class="btn btn-default">Cancelar</button>
                </div>
                <!-- /.card-footer -->
         </div>
      <!-- /.card -->
      </form>
      <!-- /form -->
      </div>
    <!-- /.container-fluid -->
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

    function actualizarUsuario(){
      var nombre = document.getElementById('nombre').value; 
      var apellido = document.getElementById('apellido').value; 
      var usuario = document.getElementById('usuario').value; 
      var id = document.getElementById('id').value;
     var pass = document.getElementById('password').value;
      var pass2 = document.getElementById('password2').value; 
      if(nombre === ''){
                toastr.error('Nombre es requerido');
                return;
            }

            if(nombre.length > 50){
                toastr.error('Máximo 50 caracteres para Nombre');
                return;
            }

            if(apellido === ''){
                toastr.error('Apellido es requerido');
                return;
            }

            if(apellido.length > 50){
                toastr.error('Máximo 50 caracteres para Nombre');
                return;
            }
            if(usuario === ''){
                toastr.error('Usuario es requerido');
                return;
            }

            if(usuario.length > 50){
                toastr.error('Máximo 50 caracteres para Usuario');
                return;
            }
            if(password.length > 0){
                if(password.length < 4){
                    toastMensaje('error', 'Mínimo 4 caracteres para contraseña')
                    return;
                }

                if(password.length > 16){
                    toastMensaje('error', 'Máximo 16 caracteres para contraseña')
                    return;
                }
            }
            openLoading();
      let formData = new FormData();
                formData.append('nombre', nombre);
                formData.append('apellido', apellido);
                formData.append('usuario', usuario);
                formData.append('id', id);

                var retorno = verificar(pass, pass2);
      // GUARDAR DATOS + CONTRASENA
      if(retorno){
                formData.append('password', pass);  
                
            axios.post(url+'editar-perfil/actualizar', formData, {
            })
                .then((response) => {
                    closeLoading();

                    if (response.data.success === 1) {
                        toastMensaje('error', 'El Usuario ya existe');
                    }
                    else if(response.data.success === 2){
                        toastr.success('Actualizado');
                    }
                    else {
                        toastMensaje('error', 'Error al actualizar');
                    }
                })
                .catch((error) => {
                    closeLoading();
                    toastMensaje('error', 'Error al actualizar');
                });


                  }
      }
    function verificar(pass, pass2){
         // contrasena no coincide
                if(pass !== pass2){
                  
                    toastr.error("Contraseña no coincide...");
                    return false;
                }else{                  
                   return true;
                }    
    }
</script>

@stop
