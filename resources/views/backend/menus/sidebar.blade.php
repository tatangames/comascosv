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

                @can('editor.sidebar.dashboard')
                    <li class="nav-item">
                        <a href="{{ route('editor.dashboard.index') }}" target="frameprincipal" class="nav-link">
                            <i class="far fa-address-book nav-icon"></i>
                            <p>Estadísticas Editor</p>
                        </a>
                    </li>
                @endcan

                <!-- DASHBOARD CLIENTE -->

                @can('cliente.sidebar.dashboard')
                <li class="nav-item">
                    <a href="{{ route('cliente.dashboard.index') }}" target="frameprincipal" class="nav-link">
                        <i class="far fa-address-book nav-icon"></i>
                        <p>Estadísticas Cliente</p>
                    </a>
                </li>
                @endcan





            </ul>
        </nav>

    </div>
</aside>