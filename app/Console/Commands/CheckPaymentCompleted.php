<?php

namespace App\Console\Commands;

use App\Enums\OrderStatusEnum;
use App\Services\OrderService;
use Illuminate\Console\Command;
use App\Tasks\Order\UpdateStatusOrderTask;
use App\Tasks\PayPal\CheckPaymentCompletedPaypalTask;

class CheckPaymentCompleted extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'check:payment-completed';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $orderService = new OrderService();
        foreach ($orderService->getAcceptedPaymentOrders() as $order) {
            if ($order->payment_method == 'paypal' && !is_null($order->payment_id)) {
                if ((new CheckPaymentCompletedPaypalTask($order))->run()) {
                    (new UpdateStatusOrderTask($order, OrderStatusEnum::STATUS_IDS['payment_completed'], null))->run();
                }
            }
        }
    }
}
