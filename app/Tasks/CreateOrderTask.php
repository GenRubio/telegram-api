<?php

namespace App\Tasks;

use Exception;
use Illuminate\Support\Facades\DB;
use App\Exceptions\GenericException;
use App\Prepares\OrderPrepare;
use App\Services\OrderProductService;
use App\Services\OrderService;

class CreateOrderTask
{
    private $request;
    private $customer;
    private $orderService;
    private $orderProductService;

    public function __construct($request, $customer)
    {
        $this->request = $request;
        $this->customer = $customer;
        $this->orderService = new OrderService();
        $this->orderProductService = new OrderProductService();
    }

    public function run()
    {
        try {
            DB::beginTransaction();
            $orderPrepare = (new OrderPrepare($this->request, $this->customer))->run();
            $this->orderService->createOrder($orderPrepare);
            DB::commit();
        } catch (GenericException | Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }
}
