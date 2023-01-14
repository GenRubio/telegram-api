<?php

namespace App\Http\Controllers\Admin;

use App\Enums\OrderStatusEnum;
use App\Http\Requests\OrderRequest;
use App\Tasks\Order\CancelOrderTask;
use App\Tasks\Order\UpdateStatusOrderTask;
use App\Tasks\Bot\SendOrderSentMessageTask;
use App\Tasks\Stripe\GetRetrieveStripeTask;
use App\Tasks\Bot\SendOrderCancelMessageTask;
use App\Tasks\Bot\SendOrderDeliveredMessageTask;
use App\Tasks\Bot\SendTrackingNumberMessageTask;
use App\Tasks\PayPal\GetRetrieveOrderPaypalTask;
use App\Http\Controllers\Admin\Traits\AdminCrudTrait;
use App\Tasks\PayPal\API\GetRetrievePaymentPaypalTask;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;
use Exception;

class OrderCrudController extends CrudController
{
    use AdminCrudTrait;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation {
        update as traitUpdate;
    }
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;

    public function setup()
    {
        if (!backpack_user()->officePermission(get_class($this), 'show')) {
            abort(403);
        }
        CRUD::setModel(\App\Models\Order::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/order');
        CRUD::setEntityNameStrings('pedido', 'pedidos');
    }

    protected function setupListOperation()
    {
        $this->removeActionsCrud();
        $this->crud->addButtonFromView('line', 'order-history-states', 'order-history-states', 'beginning');
        //$this->crud->addButtonFromView('line', 'order-payment-info', 'order-payment-info', 'beginning');
        $this->crud->addButtonFromView('line', 'order-products', 'order-products', 'beginning');
        $this->crud->addColumn([
            'name' => 'created_at',
            'label' => 'Fecha',
            'type'  => 'text',
        ]);
        $this->crud->addColumn([
            'name' => 'status',
            'label' => 'Estado',
            'type'  => 'status',
        ]);
        $this->crud->addColumn([
            'name' => 'reference',
            'label' => 'Referencia',
            'type'  => 'text',
        ]);
        $this->crud->addColumn([
            'name' => 'total_price_backpack',
            'label' => 'Precio total',
            'type'  => 'text',
        ]);
        $this->crud->addColumn([
            'name' => 'price_backpack',
            'label' => 'Precio',
            'type'  => 'text',
        ]);
        $this->crud->addColumn([
            'name' => 'shipping_price_backpack',
            'label' => 'Precio envio',
            'type'  => 'text',
        ]);
        $this->crud->addColumn([
            'name' => 'count_products',
            'label' => 'Productos',
            'type'  => 'text',
        ]);
    }

    protected function setupCreateOperation()
    {
        CRUD::setValidation(OrderRequest::class);
        $clientLanguage = $this->crud->getCurrentEntry()->telegraphChat->language->name;
        $retriveOrder = null;
        $retrivePayment = null;
        $payment_order_status = null;
        $payment_payment_status = null;
        if ($this->crud->getCurrentEntry()->payment_method == 'stripe') {
            $retriveOrder = (new GetRetrieveStripeTask($this->crud->getCurrentEntry()->stripe_id))->run();
            $payment_order_status = $retriveOrder->status;
            $payment_payment_status = $retriveOrder->payment_status;
        } else {
            $retriveOrder = (new GetRetrieveOrderPaypalTask($this->crud->getCurrentEntry()))->run();
            if ($this->crud->getCurrentEntry()->payment_id) {
                $retrivePayment = (new GetRetrievePaymentPaypalTask($this->crud->getCurrentEntry()))->run();
            }
            try {
                $payment_order_status = $retriveOrder['status'];
            } catch (Exception $e) {
                $payment_order_status = 'EXPIRED';
            }
            $payment_payment_status = $retrivePayment ? $retrivePayment->status : 'Pendiente de pago';
        }
        $this->crud->addFields([
            [
                'name' => 'reference',
                'label' => 'Numero referencia',
                'type' => 'text',
                'attributes' => [
                    'readonly'    => 'readonly',
                    'disabled'    => 'disabled',
                ],
                'tab' => 'General'
            ],
            [
                'name'        => 'status',
                'label'       => "Estado",
                'type'        => 'select_from_array',
                'options'     => $this->getListStatuses(),
                'allows_null' => false,
                'tab' => 'General'
            ],
            [
                'name' => 'order_cancel_detail',
                'label' => 'Razon de cancelacion de pedido <small>(En caso de que el estado sea Cancelado)</small><br><div style="font-size: 15px;font-weight: normal;">Idioma del cliente: ' . $clientLanguage . '</div>',
                'type' => 'textarea',
                'tab' => 'General'
            ],
            [
                'name' => 'provider_url',
                'label' => 'Url Proveedor',
                'type' => 'text',
                'tab' => 'General'
            ],
            [
                'name' => 'price',
                'label' => 'Precio',
                'type' => 'text',
                'prefix' => '€',
                'attributes' => [
                    'readonly'    => 'readonly',
                    'disabled'    => 'disabled',
                ],
                'tab' => 'General'
            ],
            [
                'name' => 'shipping_price',
                'label' => 'Precio envio',
                'type' => 'text',
                'prefix' => '€',
                'attributes' => [
                    'readonly'    => 'readonly',
                    'disabled'    => 'disabled',
                ],
                'tab' => 'General'
            ],
            [
                'name' => 'total_price',
                'label' => 'Precio total',
                'type' => 'text',
                'prefix' => '€',
                'attributes' => [
                    'readonly'    => 'readonly',
                    'disabled'    => 'disabled',
                ],
                'tab' => 'General'
            ],
            [
                'name' => 'payment_method',
                'label' => 'Metodo de pago',
                'type' => 'text',
                'attributes' => [
                    'readonly'    => 'readonly',
                    'disabled'    => 'disabled',
                ],
                'tab' => 'General'
            ],
            [
                'name' => 'name',
                'label' => 'Nombre',
                'type' => 'text',
                'tab' => 'Cliente'
            ],
            [
                'name' => 'surnames',
                'label' => 'Apellidos',
                'type' => 'text',
                'tab' => 'Cliente'
            ],
            [
                'name' => 'address',
                'label' => 'Direccion',
                'type' => 'textarea',
                'tab' => 'Cliente'
            ],
            [
                'name' => 'postal_code',
                'label' => 'Codigo postal',
                'type' => 'text',
                'tab' => 'Cliente'
            ],
            [
                'name' => 'city',
                'label' => 'Ciudad',
                'type' => 'text',
                'tab' => 'Cliente'
            ],
            [
                'name' => 'country',
                'label' => 'Pais',
                'type' => 'text',
                'tab' => 'Cliente'
            ],
            [
                'name' => 'stripe_id',
                'label' => 'ID Pedido (Stripe)',
                'type' => 'text',
                'attributes' => [
                    'readonly'    => 'readonly',
                    'disabled'    => 'disabled',
                ],
                'tab' => 'Pago'
            ],
            [
                'name' => 'paypal_id',
                'label' => 'ID Pedido (Paypal)',
                'type' => 'text',
                'attributes' => [
                    'readonly'    => 'readonly',
                    'disabled'    => 'disabled',
                ],
                'tab' => 'Pago'
            ],
            [
                'name' => 'payment_id',
                'label' => 'ID Pago',
                'type' => 'text',
                'attributes' => [
                    'readonly'    => 'readonly',
                    'disabled'    => 'disabled',
                ],
                'tab' => 'Pago'
            ],
            [
                'name' => 'payment_url_test',
                'label' => 'Url pago paypal (test)',
                'type' => 'text',
                'value' => 'https://www.sandbox.paypal.com/checkoutnow?token=' . $this->crud->getCurrentEntry()->paypal_id,
                'attributes' => [
                    'readonly'    => 'readonly',
                    'disabled'    => 'disabled',
                ],
                'tab' => 'Pago'
            ],
            [
                'name' => 'payment_order_status',
                'label' => 'Estado de pedido',
                'type' => 'text',
                'value' => $payment_order_status,
                'attributes' => [
                    'readonly'    => 'readonly',
                    'disabled'    => 'disabled',
                ],
                'tab' => 'Pago'
            ],
            [
                'name' => 'payment_payment_status',
                'label' => 'Estado de pago',
                'type' => 'text',
                'value' => $payment_payment_status,
                'attributes' => [
                    'readonly'    => 'readonly',
                    'disabled'    => 'disabled',
                ],
                'tab' => 'Pago'
            ],
        ]);
    }

    protected function setupUpdateOperation()
    {
        $this->setupCreateOperation();
    }

    private function getListStatuses()
    {
        $actualStatus = $this->crud->getCurrentEntry()->status;
        return OrderStatusEnum::STATUS_TO_STATUS[$actualStatus];
    }

    public function update()
    {
        $order = $this->crud->getCurrentEntry();
        $request = $this->crud->getRequest();
        $this->sendOrderCancelMessage($order, $request);
        $this->sendOrderSentMessage($order, $request);
        $this->sendOrderDeliveredMessage($order, $request);
        $this->sendTrackingNumberMessage($order, $request);
        return $this->traitUpdate();
    }

    private function sendOrderCancelMessage($order, $request)
    {
        if (
            $request->input('status') == OrderStatusEnum::STATUS_IDS['cancel']
            && $order->status != $request->input('status')
        ) {
            (new CancelOrderTask($order))->run();
            (new UpdateStatusOrderTask($this->order, OrderStatusEnum::STATUS_IDS['cancel'], backpack_user()))->run();
            $order->order_cancel_detail = $request->input('order_cancel_detail');
            (new SendOrderCancelMessageTask($order))->run();
        }
    }

    private function sendOrderSentMessage($order, $request)
    {
        if (
            $order->status == OrderStatusEnum::STATUS_IDS['payment_completed']
            && $request->input('status') == OrderStatusEnum::STATUS_IDS['sent']
        ) {
            (new UpdateStatusOrderTask($order, OrderStatusEnum::STATUS_IDS['sent'], backpack_user()))->run();
            (new SendOrderSentMessageTask($order))->run();
        }
    }

    private function sendOrderDeliveredMessage($order, $request)
    {
        if (
            $order->status == OrderStatusEnum::STATUS_IDS['sent']
            && $request->input('status') == OrderStatusEnum::STATUS_IDS['delivered']
        ) {
            (new UpdateStatusOrderTask($order, OrderStatusEnum::STATUS_IDS['delivered'], backpack_user()))->run();
            (new SendOrderDeliveredMessageTask($order))->run();
        }
    }

    private function sendTrackingNumberMessage($order, $request)
    {
        if (
            $order->status == OrderStatusEnum::STATUS_IDS['sent']
            && (empty($order->provider_url) && !empty($request->input('provider_url'))
                || !empty($request->input('provider_url')) && $order->provider_url != $request->input('provider_url'))
        ) {
            $order->provider_url = $request->input('provider_url');
            (new SendTrackingNumberMessageTask($order))->run();
        }
    }
}
