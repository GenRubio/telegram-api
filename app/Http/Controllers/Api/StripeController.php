<?php

namespace App\Http\Controllers\Api;

use Exception;
use Illuminate\Http\Request;
use App\Services\OrderService;
use App\Services\SettingService;
use App\Exceptions\GenericException;
use App\Http\Controllers\Controller;
use App\Tasks\Order\AcceptOrderTask;
use App\Tasks\Order\CancelOrderTask;
use Illuminate\Support\Facades\Redirect;
use App\Tasks\Stripe\CancelPaymentStripeTask;
use App\Tasks\Bot\SendPaymentCancelMessageTask;
use App\Tasks\Stripe\ValidatePaymentStripeTask;
use App\Tasks\Bot\SendSuccessPaymentMessageTask;
use App\Tasks\Bot\SendPaymentUrlCancelMessageTask;

class StripeController extends Controller
{
    public function paymentSuccess(Request $request)
    {
        try {
            $order = (new OrderService())->getPaymentOrder(decrypt($request->reference));
            if (is_null($order)) {
                throw new GenericException("Order not found");
            }
            if ((new ValidatePaymentStripeTask($order->stripe_id))->run()) {
                (new AcceptOrderTask($order))->run();
                (new CancelPaymentStripeTask($order->stripe_id))->run();
                (new SendSuccessPaymentMessageTask($order))->run();
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
            $order = (new OrderService())->getPaymentOrder(decrypt($request->reference));
            if (is_null($order)) {
                throw new GenericException("Order not found");
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
