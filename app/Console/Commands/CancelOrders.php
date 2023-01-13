<?php

namespace App\Console\Commands;

use App\Services\OrderService;
use Illuminate\Console\Command;
use App\Tasks\Order\CancelOrderTask;

class CancelOrders extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:cancel-orders';

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
        foreach ($orderService->getForAutomaticCancel() as $order) {
            (new CancelOrderTask($order))->run();
        }
    }
}
