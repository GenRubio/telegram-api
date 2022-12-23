<?php

namespace App\Services;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Repositories\Order\OrderRepository;
use App\Repositories\Order\OrderRepositoryInterface;

/**
 * Class OrderService
 * @package App\Services\Order
 */
class OrderService extends Controller
{
    private $orderRepository;

    /**
     * OrderService constructor.
     * @param Order $order
     * @param OrderRepositoryInterface $orderRepository
     */
    public function __construct()
    {
        $this->orderRepository = new OrderRepository();
    }

    public function getByReference($reference)
    {
        return $this->orderRepository->getByReference($reference);
    }
}
