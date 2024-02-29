<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <a href="{{ route('admin.panel') }}" class="brand-link">
        <img src="{{ asset('images/logocomasco.png') }}" alt="Logo" class="brand-image img-circle elevation-3" >
        <span class="brand-text font-weight" style="color: white">Comascosv</span>
    </a>

    <div class="sidebar">

        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="true">


                <!-- ROLES Y PERMISOS -->

                @can('admin.sidebar.roles.y.permisos')
                    <li class="nav-item">

                        <a href="#" class="nav-link nav-">
                            <i class="far fa-edit"></i>
                            <p>
                                Roles y Permisos
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>

                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route('admin.roles.index') }}" target="frameprincipal" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Roles</p>
                                </a>
                            </li>

                            <li class="nav-item">
                                <a href="{{ route('admin.permisos.index') }}" target="frameprincipal" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Usuarios</p>
                                </a>
                            </li>

                        </ul>
                    </li>
                @endcan

                <!-- DASHBOARD EDITOR -->


                    <li class="nav-item">
                        <a href="{{ route('editor.dashboard.index') }}" target="frameprincipal" class="nav-link">
                            <i class="far fa-address-book nav-icon"></i>
                            <p>Estadísticas Editor</p>
                        </a>
                    </li>


                <!-- DASHBOARD CLIENTE -->



                <li class="nav-item">

                    <a href="#" class="nav-link nav-">
                        <i class="far fa-edit"></i>
                        <p>
                            Recursos
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>

                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('admin.preguntas.frecuentes') }}" target="frameprincipal" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Preguntas Frecuentes</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ route('admin.vendedores') }}" target="frameprincipal" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Vendedores</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ route('admin.propiedad.etiquetas') }}" target="frameprincipal" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Propiedad Etiquetas</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ route('admin.propiedad.lugares') }}" target="frameprincipal" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Lugares</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ route('admin.presentacion.inicio') }}" target="frameprincipal" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Presentación Inicio</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ route('admin.otros.recursos') }}" target="frameprincipal" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Otros</p>
                            </a>
                        </li>


                    </ul>
                </li>


                <li class="nav-item">

                    <a href="#" class="nav-link nav-">
                        <i class="far fa-edit"></i>
                        <p>
                            Propiedades
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>

                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('admin.propiedad') }}" target="frameprincipal" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Nueva Propiedad</p>
                            </a>
                        </li>

                    </ul>
                </li>

                <li class="nav-item">

                    <a href="#" class="nav-link nav-">
                        <i class="far fa-edit"></i>
                        <p>
                            Páginas
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>

                    <ul class="nav nav-treeview">

                        <li class="nav-item">
                            <a href="{{ route('admin.pagina.contactos') }}" target="frameprincipal" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Contacto</p>
                            </a>
                        </li>

                    </ul>
                </li>




            </ul>
        </nav>

    </div>
</aside>
