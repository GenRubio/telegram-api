@if (backpack_user()->officePermission('BotCrudController', 'show') ||
        backpack_user()->officePermission('TelegramBotGroupCrudController', 'show') ||
        backpack_user()->officePermission('TelegramBotMessageCrudController', 'show') ||
        backpack_user()->officePermission('TelegramBotGlobalMessageCrudController', 'show'))
    <li class="nav-title">TELEGRAM BOT</li>
    @if (backpack_user()->officePermission('BotCrudController', 'show') ||
            backpack_user()->officePermission('TelegramBotGroupCrudController', 'show'))
        <li class="nav-item nav-dropdown">
            <a class="nav-link nav-dropdown-toggle" href="#">
                <i class="nav-icon las la-robot"></i> Bots
            </a>
            <ul class="nav-dropdown-items">
                @if (backpack_user()->officePermission('BotCrudController', 'show'))
                    <li class="nav-item">
                        <a class="nav-link" href="{{ backpack_url('bot') }}">
                            <i class="nav-icon las la-robot"></i> Bots
                        </a>
                    </li>
                @endif
                @if (backpack_user()->officePermission('TelegramBotGroupCrudController', 'show'))
                    <li class="nav-item">
                        <a class="nav-link" href="{{ backpack_url('telegram-bot-group') }}">
                            <i class="nav-icon las la-list"></i> Grupos
                        </a>
                    </li>
                @endif
            </ul>
        </li>
    @endif
    @if (backpack_user()->officePermission('TelegramBotMessageCrudController', 'show') ||
            backpack_user()->officePermission('TelegramBotGlobalMessageCrudController', 'show'))
        <li class="nav-item nav-dropdown">
            <a class="nav-link nav-dropdown-toggle" href="#">
                <i class="nav-icon las la-comments"></i> Mensajes
            </a>
            <ul class="nav-dropdown-items">
                @if (backpack_user()->officePermission('TelegramBotMessageCrudController', 'show'))
                    <li class="nav-item">
                        <a class="nav-link" href="{{ backpack_url('telegram-bot-message') }}">
                            <i class="nav-icon las la-comment-alt"></i> Mensajes
                        </a>
                    </li>
                @endif
                @if (backpack_user()->officePermission('TelegramBotGlobalMessageCrudController', 'show'))
                    <li class="nav-item">
                        <a class="nav-link" href="{{ backpack_url('telegram-bot-global-message') }}">
                            <i class="nav-icon las la-sms"></i> Globales
                        </a>
                    </li>
                @endif
            </ul>
        </li>
    @endif
@endif
