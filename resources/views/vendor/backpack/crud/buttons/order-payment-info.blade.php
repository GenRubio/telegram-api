@php
    use App\Models\Order;
    use App\Tasks\Stripe\GetRetrieveStripeTask;
    use App\Tasks\PayPal\GetRetrieveOrderPaypalTask;
    use App\Tasks\PayPal\API\GetRetrievePaymentPaypalTask;
    
    $order = Order::where('id', $entry->getKey())->first();
    $retriveOrder = null;
    $retrivePayment = null;
    if ($order->payment_method == 'stripe') {
        $retriveOrder = (new GetRetrieveStripeTask($order->stripe_id))->run();
    } else {
        $retriveOrder = (new GetRetrieveOrderPaypalTask($order))->run();
        if ($order->payment_id) {
            $retrivePayment = (new GetRetrievePaymentPaypalTask($order))->run();
        }
    }
@endphp
<a id="show-modal" class="btn btn-sm btn-link" style="color: #7c69ef !important; cursor: pointer !important;"
    data-style="zoom-in" data-toggle="modal" data-target="#showPaymentOrder{{ $entry->getKey() }}" data-backdrop="false">
    Pago
</a>
<div class="modal fade" id="showPaymentOrder{{ $entry->getKey() }}" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalCenterTitle" aria-hidden="true" style="background-color:#0000005c">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Informacion pago</h5>
                <button type="button" id="close-modal-button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="mb-2">
                    Metodo de pago: <b>{{ $order->payment_method }}</b>
                </div>
                <div class="mb-2">
                    Referencia: <b>{{ $order->reference }}</b>
                </div>
                @if ($order->payment_method == 'stripe')
                    <div class="mb-2">
                        ID Pedido: <b>{{ $order->stripe_id }}</b>
                    </div>
                @else
                    <div class="mb-2">
                        ID Pedido: <b>{{ $order->paypal_id }}</b>
                    </div>
                    <div class="mb-2">
                        ID Pago: <b>{{ $order->payment_id ? $order->payment_id : 'Pendiente de pago' }}</b>
                    </div>
                @endif
                <hr>
                <h5>API Informacion</h5>
                @if ($order->payment_method == 'stripe')
                    <div class="mb-2">
                        Estado de pago: <b>{{ $retriveOrder->payment_status }}</b>
                    </div>
                    <div class="mb-2">
                        Estado pedido: <b>{{ $retriveOrder->status }}</b>
                    </div>
                @else
                    <div class="mb-2">
                        Estado pedido: <b>{{ $retriveOrder['status'] }}</b>
                    </div>
                    @if ($retrivePayment)
                        <div class="mb-2">
                            Estado de pago: <b>{{ $retrivePayment->status }}</b>
                        </div>
                    @else
                        <div class="mb-2">
                            Estado de pago: <b>Pendiente de pago</b>
                        </div>
                    @endif
                @endif
            </div>
            <div class="modal-footer">
                <button type="button" id="cancel-modal-button" class="btn btn-secondary"
                    data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>
