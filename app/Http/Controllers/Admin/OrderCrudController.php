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
use Prologue\Alerts\Facades\Alert;

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
        //if (!backpack_user()->officePermission(get_class($this), 'show')) {
        //    abort(403);
        //}
        CRUD::setModel(\App\Models\Order::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/order');
        CRUD::setEntityNameStrings('pedido', 'pedidos');
    }

    protected function setupListOperation()
    {
        $this->removeActionsCrud();
        $this->crud->addButtonFromView('line', 'order-actions', 'order-actions', 'beginning');
        $this->crud->addColumn([
            'name' => 'created_at',
            'label' => trans('back-office.backpack_menu.orders.list.date'),
            'type'  => 'text',
        ]);
        $this->crud->addColumn([
            'name' => 'status',
            'label' => trans('back-office.backpack_menu.orders.list.state'),
            'type'  => 'status',
        ]);
        $this->crud->addColumn([
            'name' => 'reference',
            'label' => trans('back-office.backpack_menu.orders.list.reference'),
            'type'  => 'text',
        ]);
        $this->crud->addColumn([
            'name' => 'total_price_backpack',
            'label' => trans('back-office.backpack_menu.orders.list.total_price'),
            'type'  => 'text',
        ]);
        $this->crud->addColumn([
            'name' => 'price_backpack',
            'label' => trans('back-office.backpack_menu.orders.list.price'),
            'type'  => 'text',
        ]);
        $this->crud->addColumn([
            'name' => 'shipping_price_backpack',
            'label' => trans('back-office.backpack_menu.orders.list.price_shipping'),
            'type'  => 'text',
        ]);
        $this->crud->addColumn([
            'name' => 'paymentPlatformKey',
            'label' => trans('back-office.backpack_menu.orders.list.payment_keys'),
            'type'      => 'select',
            'name'      => 'payment_platform_key_id',
            'entity'    => 'paymentPlatformKey',
            'attribute' => 'description',
            'model'     => "App\Models\PaymentPlatformKey",
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
        if (
            $this->crud->getCurrentEntry()->payment_method == 'stripe'
            && $this->crud->getCurrentEntry()->stripe_id
        ) {
            $privateKeyStripe = $this->crud->getCurrentEntry()
                ->paymentAPICredentials()['secret_key'];
            $retriveOrder = (new GetRetrieveStripeTask($this->crud->getCurrentEntry()->stripe_id, $privateKeyStripe))->run();
            $payment_order_status = $retriveOrder->status;
            $payment_payment_status = $retriveOrder->payment_status;
        } else if (
            $this->crud->getCurrentEntry()->payment_method == 'paypal'
            && $this->crud->getCurrentEntry()->paypal_id
        ) {
            $retriveOrder = (new GetRetrieveOrderPaypalTask($this->crud->getCurrentEntry()))->run();
            if ($this->crud->getCurrentEntry()->payment_id) {
                $retrivePayment = (new GetRetrievePaymentPaypalTask($this->crud->getCurrentEntry()))->run();
            }
            try {
                $payment_order_status = $retriveOrder['status'];
            } catch (Exception $e) {
                $payment_order_status = 'EXPIRED';
            }
            $payment_payment_status = $retrivePayment ? $retrivePayment->status : OrderStatusEnum::STATUS()['pd_payment'];
        }
        $this->crud->addFields([
            [
                'name' => 'reference',
                'label' => trans('back-office.backpack_menu.orders.update.general.reference'),
                'type' => 'text',
                'attributes' => [
                    'readonly'    => 'readonly',
                ],
                'tab' => trans('back-office.backpack_menu.orders.update.tabs.general')
            ],
            [
                'name'        => 'status',
                'label'       => trans('back-office.backpack_menu.orders.update.general.state'),
                'type'        => 'select_from_array',
                'options'     => $this->getListStatuses(),
                'allows_null' => false,
                'tab' => trans('back-office.backpack_menu.orders.update.tabs.general')
            ],
            [
                'name' => 'order_cancel_detail',
                'label' => trans('back-office.backpack_menu.orders.update.general.payment_cancel_problem') . ' <small>(' . trans('back-office.backpack_menu.orders.update.general.explication_text') . ')</small><br><div style="font-size: 15px;font-weight: normal;">' . trans('back-office.backpack_menu.orders.update.general.client_language') . ': ' . $clientLanguage . '</div>',
                'type' => 'textarea',
                'tab' => trans('back-office.backpack_menu.orders.update.tabs.general')
            ],
            [
                'name' => 'provider_url',
                'label' => trans('back-office.backpack_menu.orders.update.general.provider_url'),
                'type' => 'text',
                'tab' => trans('back-office.backpack_menu.orders.update.tabs.general')
            ],
            [
                'name' => 'price',
                'label' => trans('back-office.backpack_menu.orders.update.general.price'),
                'type' => 'text',
                'prefix' => '€',
                'attributes' => [
                    'readonly'    => 'readonly',
                ],
                'tab' => trans('back-office.backpack_menu.orders.update.tabs.general')
            ],
            [
                'name' => 'shipping_price',
                'label' => trans('back-office.backpack_menu.orders.update.general.price_shipping'),
                'type' => 'text',
                'prefix' => '€',
                'attributes' => [
                    'readonly'    => 'readonly',
                ],
                'tab' => trans('back-office.backpack_menu.orders.update.tabs.general')
            ],
            [
                'name' => 'total_price',
                'label' => trans('back-office.backpack_menu.orders.update.general.total_price'),
                'type' => 'text',
                'prefix' => '€',
                'attributes' => [
                    'readonly'    => 'readonly',
                ],
                'tab' => trans('back-office.backpack_menu.orders.update.tabs.general')
            ],
            [
                'name' => 'name',
                'label' => trans('back-office.backpack_menu.orders.update.client.name'),
                'type' => 'text',
                'tab' => trans('back-office.backpack_menu.orders.update.tabs.client')
            ],
            [
                'name' => 'surnames',
                'label' => trans('back-office.backpack_menu.orders.update.client.surname'),
                'type' => 'text',
                'tab' => trans('back-office.backpack_menu.orders.update.tabs.client')
            ],
            [
                'name' => 'address',
                'label' => trans('back-office.backpack_menu.orders.update.client.address'),
                'type' => 'textarea',
                'tab' => trans('back-office.backpack_menu.orders.update.tabs.client')
            ],
            [
                'name' => 'postal_code',
                'label' => trans('back-office.backpack_menu.orders.update.client.postal_code'),
                'type' => 'text',
                'tab' => trans('back-office.backpack_menu.orders.update.tabs.client')
            ],
            [
                'name' => 'city',
                'label' => trans('back-office.backpack_menu.orders.update.client.city'),
                'type' => 'text',
                'tab' => trans('back-office.backpack_menu.orders.update.tabs.client')
            ],
            [
                'name' => 'province',
                'label' => trans('back-office.backpack_menu.orders.update.client.province'),
                'type' => 'text',
                'tab' => trans('back-office.backpack_menu.orders.update.tabs.client')
            ],
            [
                'name' => 'country',
                'label' => trans('back-office.backpack_menu.orders.update.client.country'),
                'type' => 'text',
                'tab' => trans('back-office.backpack_menu.orders.update.tabs.client')
            ],
            [
                'name' => 'stripe_id',
                'label' => trans('back-office.backpack_menu.orders.update.payment.stripe_order_id'),
                'type' => 'text',
                'attributes' => [
                    'readonly'    => 'readonly',
                ],
                'tab' => trans('back-office.backpack_menu.orders.update.tabs.payment')
            ],
            [
                'name' => 'paypal_id',
                'label' => trans('back-office.backpack_menu.orders.update.payment.paypal_order_id'),
                'type' => 'text',
                'attributes' => [
                    'readonly'    => 'readonly',
                ],
                'tab' => trans('back-office.backpack_menu.orders.update.tabs.payment')
            ],
            [
                'name' => 'payment_id',
                'label' => trans('back-office.backpack_menu.orders.update.payment.payment_id'),
                'type' => 'text',
                'attributes' => [
                    'readonly'    => 'readonly',
                ],
                'tab' => trans('back-office.backpack_menu.orders.update.tabs.payment')
            ],
            [
                'name' => 'payment_url_test',
                'label' => trans('back-office.backpack_menu.orders.update.payment.paypal_payment_url'),
                'type' => 'text',
                'value' => 'https://www.sandbox.paypal.com/checkoutnow?token=' . $this->crud->getCurrentEntry()->paypal_id,
                'attributes' => [
                    'readonly'    => 'readonly',
                ],
                'tab' => trans('back-office.backpack_menu.orders.update.tabs.payment')
            ],
            [
                'name' => 'payment_order_status',
                'label' => trans('back-office.backpack_menu.orders.update.payment.order_state'),
                'type' => 'text',
                'value' => $payment_order_status,
                'attributes' => [
                    'readonly'    => 'readonly',
                ],
                'tab' => trans('back-office.backpack_menu.orders.update.tabs.payment')
            ],
            [
                'name' => 'payment_payment_status',
                'label' => trans('back-office.backpack_menu.orders.update.payment.payment_state'),
                'type' => 'text',
                'value' => $payment_payment_status,
                'attributes' => [
                    'readonly'    => 'readonly',
                ],
                'tab' => trans('back-office.backpack_menu.orders.update.tabs.payment')
            ],
            [
                'name' => 'payment_method',
                'label' => trans('back-office.backpack_menu.orders.update.payment.payment_method'),
                'type' => 'text',
                'attributes' => [
                    'readonly'    => 'readonly',
                ],
                'tab' => trans('back-office.backpack_menu.orders.update.tabs.payment')
            ],
            [
                'label'     => trans('back-office.backpack_menu.orders.update.payment.payment_keys'),
                'type'      => 'select',
                'name'      => 'payment_platform_key_id',
                'entity'    => 'paymentPlatformKey',
                'model'     => "App\Models\PaymentPlatformKey",
                'attribute' => 'name',
                'attributes' => [
                    'readonly'    => 'readonly',
                ],
                'tab' => trans('back-office.backpack_menu.orders.update.tabs.payment')
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
        return OrderStatusEnum::STATUS_TO_STATUS()[$actualStatus];
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
            (new UpdateStatusOrderTask($order, OrderStatusEnum::STATUS_IDS['cancel'], backpack_user()))->run();
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
            if (!isUrl($request->input('provider_url'))) {
                Alert::error(trans('back-office.backpack_menu.orders.update.errors.invalid_url'))->flush();
            } else {
                $order->provider_url = $request->input('provider_url');
                (new SendTrackingNumberMessageTask($order))->run();
            }
        }
    }
}
