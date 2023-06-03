<li class="nav-title">{{ trans('back-office.backpack_menu.labels.admin') }}</li>
<li class="nav-item nav-dropdown">
    <a class="nav-link nav-dropdown-toggle" href="#">
        <i class="nav-icon la la-th-list"></i> {{ trans('back-office.backpack_menu.buttons.backoffice') }}
    </a>
    <ul class="nav-dropdown-items">
        <li class="nav-item"><a class="nav-link" href="{{ backpack_url('parametric-table') }}"><i
                    class="nav-icon la la-th-list"></i>
                {{ trans('back-office.backpack_menu.buttons.parametric_tables') }}</a></li>
        <li class="nav-item"><a class="nav-link" href="{{ backpack_url('language/texts') }}"><i
                    class="nav-icon la la-language"></i>
                {{ trans('back-office.backpack_menu.buttons.site_translation') }}</a></li>
    </ul>
</li>
<li class="nav-item nav-dropdown">
    <a class="nav-link nav-dropdown-toggle" href="#">
        <i class="nav-icon la la-th-list"></i> {{ trans('back-office.backpack_menu.buttons.users') }}
    </a>
    <ul class="nav-dropdown-items">

        <li class="nav-item"><a class="nav-link" href="{{ backpack_url('user') }}"><i class="nav-icon las la-users"></i>
                {{ trans('back-office.backpack_menu.buttons.users') }}</a></li>
        <li class="nav-item"><a class="nav-link" href="{{ backpack_url('office-permission') }}"><i
                    class="nav-icon las la-folder-open"></i>
                {{ trans('back-office.backpack_menu.buttons.permissions') }}</a></li>
    </ul>
</li>
<li class="nav-item nav-dropdown">
    <a class="nav-link nav-dropdown-toggle" href="#">
        <i class="nav-icon la la-th-list"></i> {{ trans('back-office.backpack_menu.buttons.server') }}
    </a>
    <ul class="nav-dropdown-items">
        <li class="nav-item"><a class="nav-link" href="{{ backpack_url('api-client') }}"><i
                    class="nav-icon las la-server"></i>
                {{ trans('back-office.backpack_menu.buttons.api_clients') }}</a></li>
        <li class="nav-item"><a class="nav-link" href="{{ backpack_url('geocoding-api') }}"><i
                    class="nav-icon las la-database"></i>
                {{ trans('back-office.backpack_menu.buttons.geocoding') }}</a></li>
        <li class="nav-item"><a class="nav-link" href="{{ backpack_url('payment-platform-key') }}"><i
                    class="nav-icon la la-th-list"></i>
                {{ trans('back-office.backpack_menu.buttons.payment_keys') }}</a></li>
        <li class="nav-item"><a class="nav-link" href="{{ backpack_url('elfinder') }}"><i
                    class="nav-icon la la-files-o"></i>
                {{ trans('back-office.backpack_menu.buttons.elfinder') }}</a></li>
        <li class='nav-item'><a class='nav-link' href='{{ backpack_url('backup') }}'><i
                    class='nav-icon la la-hdd-o'></i>
                {{ trans('back-office.backpack_menu.buttons.backups') }}</a></li>
        <li class='nav-item'><a class='nav-link' href='{{ backpack_url('log') }}'><i
                    class='nav-icon la la-terminal'></i>
                {{ trans('back-office.backpack_menu.buttons.logs') }}</a></li>
    </ul>
</li>
</li>
