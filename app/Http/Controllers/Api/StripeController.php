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
use App\Services\TelegraphChatService;
use Illuminate\Support\Facades\Redirect;
use App\Tasks\Order\UpdateStatusOrderTask;
use App\Tasks\Stripe\CancelPaymentStripeTask;
use App\Tasks\Bot\SendPaymentErrorMessageTask;
use App\Tasks\Bot\SendPaymentCancelMessageTask;
use App\Tasks\Stripe\ValidatePaymentStripeTask;
use App\Tasks\Bot\SendSuccessPaymentMessageTask;
use Illuminate\Support\Facades\Log;

class StripeController extends Controller
{
    public function paymentSuccess(Request $request)
    {
        try {
            $reference = decrypt($request->reference);
            $telegraphChat = (new TelegraphChatService())->getByChatId(requestAttrEncrypt($request->token));
            $order = (new OrderService())->getPaymentOrder($reference);
            if (is_null($order)) {
                $order = (new OrderService())->getByReference($reference);
                if (!is_null($order)) {
                    (new SendPaymentErrorMessageTask($order))->run();
                } else {
                    throw new GenericException("Error");
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
            Log::error($e);
            //return Redirect::to($telegraphChat->bot->bot_url);
        }
        return Redirect::to($telegraphChat->bot->bot_url);
    }

    public function paymentError(Request $request)
    {
        try {
            $reference = decrypt($request->reference);
            $telegraphChat = (new TelegraphChatService())->getByChatId(requestAttrEncrypt($request->token));
            $order = (new OrderService())->getPaymentOrder($reference);
            if (is_null($order)) {
                $order = (new OrderService())->getByReference($reference);
                if (!is_null($order)) {
                    return Redirect::to($order->bot()->bot_url);
                } else {
                    throw new GenericException("Error");
                }
            }
            (new CancelOrderTask($order))->run();
            (new SendPaymentCancelMessageTask($order))->run();
        } catch (GenericException | Exception $e) {
            dd($e);
            return Redirect::to($telegraphChat->bot->bot_url);
        }
        return Redirect::to($telegraphChat->bot->bot_url);
    }
}
