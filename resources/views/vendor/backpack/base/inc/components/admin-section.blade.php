<li class="nav-title">ADMINISTRACION</li>
<li class="nav-item nav-dropdown">
    <a class="nav-link nav-dropdown-toggle" href="#"><i class="nav-icon la la-th-list"></i> Configuracion</a>
    <ul class="nav-dropdown-items">
        @if (backpack_user()->officePermission('UserCrudController', 'show') ||
                backpack_user()->officePermission('OfficePermissionCrudController', 'show'))
            <li class="nav-item nav-dropdown">
                <a class="nav-link nav-dropdown-toggle" href="#">
                    <i class="nav-icon la la-th-list"></i> Usuarios
                </a>
                <ul class="nav-dropdown-items">
                    @if (backpack_user()->officePermission('UserCrudController', 'show'))
                        <li class="nav-item"><a class="nav-link" href="{{ backpack_url('user') }}"><i
                                    class="nav-icon las la-users"></i>
                                Usuarios</a></li>
                    @endif
                    @if (backpack_user()->officePermission('OfficePermissionCrudController', 'show'))
                        <li class="nav-item"><a class="nav-link" href="{{ backpack_url('office-permission') }}"><i
                                    class="nav-icon las la-folder-open"></i> Permisos</a></li>
                    @endif
                </ul>
            </li>
            <li class="nav-item nav-dropdown">
                <a class="nav-link nav-dropdown-toggle" href="#">
                    <i class="nav-icon la la-th-list"></i> Servidor
                </a>
                <ul class="nav-dropdown-items">
                    @if (backpack_user()->officePermission('ApiClientCrudController', 'show'))
                        <li class="nav-item"><a class="nav-link" href="{{ backpack_url('api-client') }}"><i
                                    class="nav-icon las la-server"></i> API Clientes</a></li>
                    @endif
                    @if (backpack_user()->officePermission('GeocodingApiCrudController', 'show'))
                        <li class="nav-item"><a class="nav-link" href="{{ backpack_url('geocoding-api') }}"><i
                                    class="nav-icon las la-database"></i> Geocoding</a></li>
                    @endif
                    <li class="nav-item"><a class="nav-link" href="{{ backpack_url('payment-platform-key') }}"><i
                                class="nav-icon la la-th-list"></i> P.P. Llaves</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ backpack_url('elfinder') }}"><i
                                class="nav-icon la la-files-o"></i>
                            Elfinder</a></li>
                    <li class='nav-item'><a class='nav-link' href='{{ backpack_url('backup') }}'><i
                                class='nav-icon la la-hdd-o'></i>
                            Backups</a></li>
                    <li class='nav-item'><a class='nav-link' href='{{ backpack_url('log') }}'><i
                                class='nav-icon la la-terminal'></i>
                            Logs</a></li>
                </ul>
            </li>
        @endif
    </ul>
</li>
