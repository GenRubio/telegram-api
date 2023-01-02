<?php

namespace App\Http\Controllers\Api;

use Exception;
use Illuminate\Http\Request;
use App\Services\OrderService;
use App\Tasks\AcceptOrderTask;
use App\Tasks\CancelOrderTask;
use App\Services\SettingService;
use App\Exceptions\GenericException;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;
use App\Tasks\Stripe\ValidatePaymentTask;
use App\Tasks\Stripe\CancelPaymentStripeTask;
use App\Tasks\Bot\SendSuccessPaymentMessageTask;

class StripeController extends Controller
{
    public function paymentSuccess(Request $request)
    {
        try {
            $order = (new OrderService())->getPaymentOrder(decrypt($request->reference));
            if (is_null($order)) {
                throw new GenericException("Order not found");
            }
            if ((new ValidatePaymentTask($order->stripe_id))->run()) {
                (new AcceptOrderTask($order))->run();
                (new CancelPaymentStripeTask($order->stripe_id))->run();
                (new SendSuccessPaymentMessageTask($order))->run();
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
        } catch (GenericException | Exception $e) {
            $settingService = new SettingService();
            return Redirect::to($settingService->getByKey('1671894524.6744')->value);
        }
        return Redirect::to($order->bot()->bot_url);
    }
}
