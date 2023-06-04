<style>
    .custom-dropdown-item {
        padding-top: 10px !important;
        padding-bottom: 10px !important;
    }
</style>
<span class="dropdown">
    <button class="btn btn-sm btn-link dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown"
        aria-haspopup="true" aria-expanded="false">
        {{ trans('back-office.backpack_menu.bots.list.actions') }}
    </button>
    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
        <a class="dropdown-item custom-dropdown-item"
            href="{{ url($crud->route . '/' . $entry->getKey()) }}/telegraph-chat">
            <i class="las la-plus"></i> {{ trans('back-office.backpack_menu.bots.list.action_buttons.chats') }}
            ({{ $entry->telegraphChats->count() }})
        </a>
        <a class="dropdown-item custom-dropdown-item"
            href="{{ url($crud->route . '/' . $entry->getKey()) }}/telegram-bot-command">
            <i class="las la-plus"></i> {{ trans('back-office.backpack_menu.bots.list.action_buttons.commands') }}
            ({{ $entry->telegramBotCommands->count() }})
        </a>
    </div>
</span>
