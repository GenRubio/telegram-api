@php
    use App\Models\Order;
    use App\Enums\OrderStatusEnum;
    $order = Order::where('id', $entry->getKey())->first();
@endphp
<style>
    .status-container {
        padding: 6px;
        border-radius: 7px;
        color: white;
        cursor: default;
    }
</style>
<a id="show-modal" class="btn btn-sm btn-link" style="color: #7c69ef !important; cursor: pointer !important;"
    data-style="zoom-in" data-toggle="modal" data-target="#showHistoryStatesOrder{{ $entry->getKey() }}"
    data-backdrop="false">
    Estados
</a>
<div class="modal fade" id="showHistoryStatesOrder{{ $entry->getKey() }}" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalCenterTitle" aria-hidden="true" style="background-color:#0000005c">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Historico de estados</h5>
                <button type="button" id="close-modal-button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="mb-1">
                    Pedido: <b>{{ $order->reference }}</b>
                </div>
                <div>
                    Metodo pago: <b>{{ $order->payment_method }}</b>
                </div>
                <hr>
                <div class="row" style="align-items: center;">
                    <div class="col-md-4">
                        Fecha
                    </div>
                    <div class="col-md-4">
                        Estado
                    </div>
                    <div class="col-md-4">
                        Usuario
                    </div>
                </div>
                @foreach ($order->orderHistoryStates as $orderState)
                    @php
                        $status = $orderState->state;
                        $name = OrderStatusEnum::STATUS[$status];
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
                    data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>
