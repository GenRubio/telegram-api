<?php

namespace App\Tasks\Order;

use Exception;
use App\Enums\OrderStatusEnum;
use App\Prepares\OrderPrepare;
use App\Services\OrderService;
use Illuminate\Support\Facades\DB;
use App\Exceptions\GenericException;
use App\Prepares\OrderProductPrepare;
use App\Services\OrderProductService;
use App\Services\ProductModelsFlavorService;

class CreateOrderTask
{
    private $request;
    private $customer;
    private $orderService;
    private $orderProductService;
    private $validateProductStock;
    private $productModelsFlavorService;
    public $order;

    public function __construct($request, $customer, $validateProductStock)
    {
        $this->request = $request;
        $this->customer = $customer;
        $this->orderService = new OrderService();
        $this->orderProductService = new OrderProductService();
        $this->validateProductStock = $validateProductStock;
        $this->productModelsFlavorService = new ProductModelsFlavorService();

        $this->run();
    }

    public function run()
    {
        $this->blockFlavorStock();
        try {
            DB::beginTransaction();
            $orderPrepare = (new OrderPrepare($this->request, $this->customer))->run();
            $this->order = $this->orderService->createOrder($orderPrepare);
            (new UpdateStatusOrderTask($this->order, OrderStatusEnum::STATUS_IDS['pd_payment']))->run();
            $prderProductPrepare = (new OrderProductPrepare($this->order, $this->validateProductStock))->run();
            $this->orderProductService->createOrderProducts($prderProductPrepare);
            DB::commit();
        } catch (GenericException | Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

    private function blockFlavorStock()
    {
        foreach ($this->validateProductStock->flavors as $item) {
            $this->productModelsFlavorService->updateBlockedStock($item['flavor']->id, $item['amount']);
        }
    }
}
