<style>
    .custom-dropdown-item {
        padding-top: 10px !important;
        padding-bottom: 10px !important;
    }
</style>
<span class="dropdown">
    <button class="btn btn-sm btn-link dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown"
        aria-haspopup="true" aria-expanded="false">
        Acciones
    </button>
    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
        <a class="dropdown-item custom-dropdown-item"
            href="{{ url($crud->route . '/' . $entry->getKey()) }}/telegraph-chat">
            <i class="las la-plus"></i> Chats ({{ $entry->telegraphChats->count() }})
        </a>
        <a class="dropdown-item custom-dropdown-item"
            href="{{ url($crud->route . '/' . $entry->getKey()) }}/telegram-bot-command">
            <i class="las la-plus"></i> Comandos ({{ $entry->telegramBotCommands->count() }})
        </a>
    </div>
</span>
