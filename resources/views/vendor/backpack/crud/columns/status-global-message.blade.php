@php
    use App\Enums\BotGlobalMessagesEnum;
    $status = $entry->{$column['name']};
    $name = BotGlobalMessagesEnum::STATUS()[$status];
    $color = BotGlobalMessagesEnum::STATUS_COLORS[$status];
@endphp
<style>
    .status-container {
        padding: 6px;
        border-radius: 7px;
        color: white;
        cursor: default;
    }
</style>
<td>
    <div class="status-container" style="background-color: {{ $color }}">
        {{ $name }}
    </div>
</td>
