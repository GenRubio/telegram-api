<li class="nav-title">{{ trans('back-office.backpack_menu.labels.config') }}</li>
<li class="nav-item"><a class="nav-link" href="{{ backpack_url('language') }}"><i class="nav-icon las la-globe"></i>
        {{ trans('back-office.backpack_menu.buttons.languages') }}</a></li>
<li class="nav-item"><a class="nav-link" href="{{ backpack_url('translation') }}"><i class="nav-icon las la-language"></i>
        {{ trans('back-office.backpack_menu.buttons.translations') }}</a></li>
<li class="nav-item nav-dropdown">
    <a class="nav-link nav-dropdown-toggle" href="#"><i class="nav-icon la la-th-list"></i>
        {{ trans('back-office.backpack_menu.buttons.extras') }}</a>
    <ul class="nav-dropdown-items">
        <li class="nav-item"><a class="nav-link" href="{{ backpack_url('setting') }}"><i
                    class="nav-icon las la-tools"></i> {{ trans('back-office.backpack_menu.buttons.config') }}</a></li>
        <li class="nav-item"><a class="nav-link" href="{{ backpack_url('settings-table') }}"><i
                    class="nav-icon la la-th-list"></i> {{ trans('back-office.backpack_menu.buttons.config') }}</a></li>
        <li class="nav-item"><a class="nav-link" href="{{ backpack_url('social-networks-table') }}"><i
                    class="nav-icon la la-th-list"></i>
                {{ trans('back-office.backpack_menu.buttons.social_networks') }}</a></li>
    </ul>
</li>
