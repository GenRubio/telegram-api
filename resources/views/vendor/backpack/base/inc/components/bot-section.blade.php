<li class="nav-title">{{ trans('back-office.backpack_menu.labels.telegram_bot') }}</li>
<li class="nav-item nav-dropdown">
    <a class="nav-link nav-dropdown-toggle" href="#">
        <i class="nav-icon las la-robot"></i> {{ trans('back-office.backpack_menu.buttons.bots') }}
    </a>
    <ul class="nav-dropdown-items">
        <li class="nav-item">
            <a class="nav-link" href="{{ backpack_url('bot') }}">
                <i class="nav-icon las la-robot"></i> {{ trans('back-office.backpack_menu.buttons.bots') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ backpack_url('telegram-bot-group') }}">
                <i class="nav-icon las la-list"></i> {{ trans('back-office.backpack_menu.buttons.grups') }}
            </a>
        </li>
    </ul>
</li>
<li class="nav-item nav-dropdown">
    <a class="nav-link nav-dropdown-toggle" href="#">
        <i class="nav-icon las la-comments"></i> {{ trans('back-office.backpack_menu.buttons.messages') }}
    </a>
    <ul class="nav-dropdown-items">
        <li class="nav-item">
            <a class="nav-link" href="{{ backpack_url('telegram-bot-global-message') }}">
                <i class="nav-icon las la-sms"></i> {{ trans('back-office.backpack_menu.buttons.glabals') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ backpack_url('telegram-bot-message') }}">
                <i class="nav-icon las la-comment-alt"></i> {{ trans('back-office.backpack_menu.buttons.default') }}
            </a>
        </li>
    </ul>
</li>
