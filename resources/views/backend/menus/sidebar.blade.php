<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <a href="#" class="brand-link">
        <img src="{{ asset('images/icono-sistema.png') }}" alt="Logo" class="brand-image img-circle elevation-3" >
        <span class="brand-text font-weight" style="color: white">TESORERÍA MUNICIPAL</span>
    </a>

    <div class="sidebar">

        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

    <!-- Grupo Roles y permisos -->
             <li class="nav-item">

                 <a href="#" class="nav-link">
                    <i class="far fa-edit"></i>
                    <p>
                        Configuraciones
                        <i class="fas fa-angle-left right"></i>
                    </p>
                </a>

                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="{{ route('admin.roles.index') }}" target="frameprincipal" class="nav-link">
                            <i class="fas fa-user-friends nav-icon"></i>
                            <p>Roles</p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('admin.permisos.index') }}" target="frameprincipal" class="nav-link">
                            <i class="fas fa-user-shield nav-icon"></i>
                            <p>Permisos y Usuarios</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('admin.tipopro.index') }}" target="frameprincipal" class="nav-link">
                            <i class="fas fa-list nav-icon"></i>
                            <p>Tipos de Proveedor</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('admin.codigopais.index') }}" target="frameprincipal" class="nav-link">
                            <i class="fas fa-list nav-icon"></i>
                            <p>Código de País</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('admin.codigoret.index') }}" target="frameprincipal" class="nav-link">
                            <i class="fas fa-list nav-icon"></i>
                            <p>Código de Retención</p>
                        </a>
                    </li>
                </ul>
             </li>
            
            <!-- Grupo Proveedor -->
                                <li class="nav-item">
                                <a href="#" class="nav-link">
                                    <i class="fas fa-building"></i>
                                    <p>Proveedor 
                                    <i class="right fas fa-angle-left"></i>
                                    </p>
                                </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                <a href="{{ route('admin.proveedor.index') }}" target="frameprincipal" class="nav-link">
                                    <i class="fas fa-id-badge nav-icon"></i>
                                    <p>Listar Proveedor</p>
                                    </a>
                                    </li>
                            </ul>
                <!-- Finaliza Grupo Proveedor -->
                <!-- Grupo Empleado -->
                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                <i class="fas fa-people-arrows"></i>
                                <p>Empleados <i class="right fas fa-angle-left"></i></p>
                                </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route('admin.empleado.index') }}" target="frameprincipal" class="nav-link">
                                <i class="fas fa-id-badge nav-icon"></i>
                                <p>Listar Empleados</p>
                                </a>
                            </li>
                        </ul>
                <!-- Finaliza Grupo Empleado -->
                 <!-- Grupo Reportes -->
                 <li class="nav-item">
                                <a href="#" class="nav-link">
                                    <i class="fas fa-building"></i>
                                    <p>Reportes 
                                    <i class="right fas fa-angle-left"></i>
                                    </p>
                                </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                <a href="{{ route('admin.reportes.index') }}" target="frameprincipal" class="nav-link">
                                    <i class="fas fa-id-badge nav-icon"></i>
                                    <p>Generar CSV</p>
                                    </a>
                                    </li>
                                    <li class="nav-item">
                                <a href="{{ route('admin.proveedor.index') }}" target="frameprincipal" class="nav-link">
                                    <i class="fas fa-id-badge nav-icon"></i>
                                    <p>Por Individuo</p>
                                    </a>
                                    </li>
                            </ul>
                <!-- Finaliza Grupo Reportes -->
                    </ul>
                </li>

            </ul>
        </nav>




    </div>
</aside>
