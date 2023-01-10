<?php

namespace App\Http\Controllers\Api;

use Exception;
use Illuminate\Http\Request;
use App\Enums\OrderStatusEnum;
use App\Services\OrderService;
use App\Exceptions\GenericException;
use App\Http\Controllers\Controller;
use App\Tasks\Order\AcceptOrderTask;
use App\Tasks\Order\CancelOrderTask;
use Illuminate\Support\Facades\Redirect;
use App\Tasks\Order\UpdateStatusOrderTask;
use App\Tasks\Stripe\CancelPaymentStripeTask;
use App\Tasks\Bot\SendPaymentErrorMessageTask;
use App\Tasks\Bot\SendPaymentCancelMessageTask;
use App\Tasks\Stripe\ValidatePaymentStripeTask;
use App\Tasks\Bot\SendSuccessPaymentMessageTask;

class StripeController extends Controller
{
    public function paymentSuccess(Request $request)
    {
        try {
            $reference = decrypt($request->reference);
            $order = (new OrderService())->getPaymentOrder($reference);
            if (is_null($order)) {
                $order = (new OrderService())->getByReference($reference);
                if (!is_null($order)) {
                    (new SendPaymentErrorMessageTask($order))->run();
                } else {
                    throw new GenericException("Order not found");
                }
            }
            if ((new ValidatePaymentStripeTask($order->stripe_id))->run()) {
                (new AcceptOrderTask($order))->run();
                (new CancelPaymentStripeTask($order->stripe_id))->run();
                (new SendSuccessPaymentMessageTask($order))->run();
            } else {
                (new CancelPaymentStripeTask($order->stripe_id))->run();
                (new UpdateStatusOrderTask($order, OrderStatusEnum::STATUS_IDS['payment_denied'], null))->run();
                (new SendPaymentErrorMessageTask($order))->run();
            }
        } catch (GenericException | Exception $e) {
            return Redirect::to(settings('1671894524.6744'));
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
                    return Redirect::to($order->bot()->bot_url);
                } else {
                    throw new GenericException("Order not found");
                }
            }
            (new CancelOrderTask($order))->run();
            (new SendPaymentCancelMessageTask($order))->run();
        } catch (GenericException | Exception $e) {
            return Redirect::to(settings('1671894524.6744'));
        }
        return Redirect::to($order->bot()->bot_url);
    }
}
