<?php

namespace App\Http\Controllers\Api;

use Exception;
use Illuminate\Http\Request;
use App\Enums\OrderStatusEnum;
use App\Services\OrderService;
use App\Services\SettingService;
use App\Exceptions\GenericException;
use App\Http\Controllers\Controller;
use App\Tasks\Order\AcceptOrderTask;
use App\Tasks\Order\CancelOrderTask;
use Illuminate\Support\Facades\Redirect;
use App\Tasks\PayPal\LatePaymentPaypalTask;
use App\Tasks\PayPal\OrderApprovedPaypalTask;
use App\Tasks\Bot\SendPaymentErrorMessageTask;
use App\Tasks\Bot\SendPaymentCancelMessageTask;
use App\Tasks\Bot\SendSuccessPaymentMessageTask;
use App\Tasks\PayPal\AuthorizePaymentPaypalTask;
use App\Tasks\Bot\SendPaymentUrlCancelMessageTask;

class PaypalController extends Controller
{
    public function paymentSuccess(Request $request)
    {
        try {
            $reference = decrypt($request->reference);
            $order = (new OrderService())->getPaymentOrder($reference);
            if (is_null($order)) {
                $order = (new OrderService())->getByReference($reference);
                if (!is_null($order)) {
                    if ((new OrderApprovedPaypalTask($order))->run()
                        && $order->status == OrderStatusEnum::STATUS_IDS['cancel']
                    ) {
                        (new LatePaymentPaypalTask($order))->run();
                    } else {
                        (new SendPaymentUrlCancelMessageTask($order))->run();
                    }
                } else {
                    throw new GenericException("Order not found");
                }
            }
            if ((new OrderApprovedPaypalTask($order))->run()) {
                $response = (new AuthorizePaymentPaypalTask($order))->run();
                if ($response) {
                    (new AcceptOrderTask($order))->run();
                    (new SendSuccessPaymentMessageTask($order))->run();
                } else {
                    (new SendPaymentErrorMessageTask($order))->run();
                }
            } else {
                (new SendPaymentUrlCancelMessageTask($order))->run();
            }
        } catch (GenericException | Exception $e) {
            $settingService = new SettingService();
            return Redirect::to($settingService->getByKey('1671894524.6744')->value);
        }
        return Redirect::to($order->bot()->bot_url);
    }

    public function paymentError(Request $request)
    {
        try {
            $reference = decrypt($request->reference);
            $order = (new OrderService())->getPaymentOrder($reference);
            if (is_null($order)) {
                $order = (new OrderService())->getByReference($reference);
                if (!is_null($order)) {
                    (new SendPaymentUrlCancelMessageTask($order))->run();
                } else {
                    throw new GenericException("Order not found");
                }
            }
            (new CancelOrderTask($order))->run();
            (new SendPaymentCancelMessageTask($order))->run();
        } catch (GenericException | Exception $e) {
            $settingService = new SettingService();
            return Redirect::to($settingService->getByKey('1671894524.6744')->value);
        }
        return Redirect::to($order->bot()->bot_url);
    }
}
