<?php

namespace App\Services;

use App\Http\Controllers\Controller;
use App\Models\OrderProduct;
use App\Repositories\OrderProduct\OrderProductRepository;
use App\Repositories\OrderProduct\OrderProductRepositoryInterface;

/**
 * Class OrderProductService
 * @package App\Services\OrderProduct
 */
class OrderProductService extends Controller
{
    private $orderproductRepository;

    /**
     * OrderProductService constructor.
     * @param OrderProduct $orderproduct
     * @param OrderProductRepositoryInterface $orderproductRepository
     */
    public function __construct()
    {
        $this->orderproductRepository = new OrderProductRepository();
    }

    public function createOrderProducts($data)
    {
        $this->orderproductRepository->createOrderProducts($data);
    }
}
