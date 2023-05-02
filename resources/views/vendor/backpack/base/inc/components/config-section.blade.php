@if (backpack_user()->officePermission('LanguageCrudController', 'show') ||
        backpack_user()->officePermission('ApiClientCrudController', 'show') ||
        backpack_user()->officePermission('SettingCrudController', 'show'))
    <li class="nav-title">CONFIGURACION</li>
    @if (backpack_user()->officePermission('LanguageCrudController', 'show'))
        <li class="nav-item"><a class="nav-link" href="{{ backpack_url('language') }}"><i class="nav-icon las la-globe"></i>
                Idiomas</a></li>
    @endif
    @if (backpack_user()->officePermission('TranslationCrudController', 'show'))
        <li class="nav-item"><a class="nav-link" href="{{ backpack_url('translation') }}"><i
                    class="nav-icon las la-language"></i> Traducciones</a></li>
    @endif
    <li class="nav-item nav-dropdown">
        <a class="nav-link nav-dropdown-toggle" href="#"><i class="nav-icon la la-th-list"></i> Extras</a>
        <ul class="nav-dropdown-items">
            @if (backpack_user()->officePermission('SettingCrudController', 'show'))
                <li class="nav-item"><a class="nav-link" href="{{ backpack_url('setting') }}"><i
                            class="nav-icon las la-tools"></i> Configuración</a></li>
            @endif
            <li class="nav-item"><a class="nav-link" href="{{ backpack_url('settings-table') }}"><i
                        class="nav-icon la la-th-list"></i> Configuración</a></li>
            <li class="nav-item"><a class="nav-link" href="{{ backpack_url('social-networks-table') }}"><i
                        class="nav-icon la la-th-list"></i> Redes</a></li>
        </ul>
    </li>
@endif
