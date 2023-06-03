@php
    use App\Models\Order;
    use App\Enums\OrderStatusEnum;
    $order = Order::where('id', $entry->getKey())->first();
@endphp
<style>
    .custom-dropdown-item {
        padding-top: 10px !important;
        padding-bottom: 10px !important;
    }

    .status-container {
        padding: 6px;
        border-radius: 7px;
        color: white;
        cursor: default;
    }
</style>
<span class="dropdown">
    <button class="btn btn-sm btn-link dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown"
        aria-haspopup="true" aria-expanded="false">
        {{ trans('back-office.backpack_menu.orders.list.actions') }}
    </button>
    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
        <a class="dropdown-item custom-dropdown-item"
            href="{{ url($crud->route . '/' . $entry->getKey()) }}/order-product">
            <i class="la la-eye"></i> {{ trans('back-office.backpack_menu.orders.list.action_buttons.products') }}
            ({{ $entry->orderProducts->count() }})
        </a>
        <a id="show-modal" class="dropdown-item custom-dropdown-item" style="cursor: pointer" data-style="zoom-in"
            data-toggle="modal" data-target="#showHistoryStatesOrder{{ $entry->getKey() }}" data-backdrop="false">
            <i class="la la-eye"></i> {{ trans('back-office.backpack_menu.orders.list.action_buttons.states') }}
            ({{ $order->orderHistoryStates->count() }})
        </a>
    </div>
</span>

<div class="modal fade" id="showHistoryStatesOrder{{ $entry->getKey() }}" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalCenterTitle" aria-hidden="true" style="background-color:#0000005c">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">
                    {{ trans('back-office.backpack_menu.orders.list.state_modal.history_state') }}</h5>
                <button type="button" id="close-modal-button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="mb-1">
                    {{ trans('back-office.backpack_menu.orders.list.state_modal.reference') }}:
                    <b>{{ $order->reference }}</b>
                </div>
                <div>
                    {{ trans('back-office.backpack_menu.orders.list.state_modal.payment_method') }}:
                    <b>{{ $order->payment_method }}</b>
                </div>
                <hr>
                <div class="row" style="align-items: center;">
                    <div class="col-md-4">
                        {{ trans('back-office.backpack_menu.orders.list.state_modal.date') }}
                    </div>
                    <div class="col-md-4">
                        {{ trans('back-office.backpack_menu.orders.list.state_modal.state') }}
                    </div>
                    <div class="col-md-4">
                        {{ trans('back-office.backpack_menu.orders.list.state_modal.user') }}
                    </div>
                </div>
                @foreach ($order->orderHistoryStates as $orderState)
                    @php
                        $status = $orderState->state;
                        $name = OrderStatusEnum::STATUS()[$status];
                        $color = OrderStatusEnum::STATUS_COLORS[$status];
                    @endphp
                    <hr>
                    <div class="row" style="align-items: center;">
                        <div class="col-md-4">
                            {{ $orderState->date }}
                        </div>
                        <div class="col-md-4">
                            <div class="status-container" style="background-color: {{ $color }}">
                                {{ $name }}
                            </div>
                        </div>
                        <div class="col-md-4">
                            {{ $orderState->user ? $orderState->user->name : 'BackOffice' }}
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="modal-footer">
                <button type="button" id="cancel-modal-button" class="btn btn-secondary"
                    data-dismiss="modal">{{ trans('back-office.backpack_menu.orders.list.state_modal.close') }}</button>
            </div>
        </div>
    </div>
</div>
