<?php

namespace App\Services;

use App\Models\Order;
use App\Enums\OrderStatusEnum;
use App\Http\Controllers\Controller;
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

    public function getById($id)
    {
        return $this->orderRepository->getById($id);
    }

    public function getByReference($reference)
    {
        return $this->orderRepository->getByReference($reference);
    }

    public function getByReferenceAndStatus($reference, $status)
    {
        return $this->orderRepository->getByReferenceAndStatus($reference, $status);
    }

    public function getPaymentOrder($reference)
    {
        $settingService = new SettingService();
        $subminutes = $settingService->getByKey('1671967273.4378')->value;
        $status = OrderStatusEnum::STATUS_IDS['pd_payment'];
        return $this->orderRepository->getPaymentOrder($reference, $status, $subminutes);
    }

    public function getForAutomaticCancel()
    {
        $settingService = new SettingService();
        $subminutes = $settingService->getByKey('1671967273.4378')->value;
        $status = OrderStatusEnum::STATUS_IDS['pd_payment'];
        return $this->orderRepository->getForAutomaticCancel($status, $subminutes);
    }

    public function getAcceptedPaymentOrders()
    {
        $status = OrderStatusEnum::STATUS_IDS['payment_accepted'];
        return $this->orderRepository->getByStatus($status);
    }

    public function createOrder($data)
    {
        return $this->orderRepository->createOrder($data);
    }

    public function updateStatus($id, $status)
    {
        $this->orderRepository->updateStatus($id, $status);
    }

    public function updateStripeId($id, $stripeId)
    {
        $this->orderRepository->updateStripeId($id, $stripeId);
    }

    public function updatePaypalId($id, $paypalId)
    {
        $this->orderRepository->updatePaypalId($id, $paypalId);
    }

    public function updatePaymentId($id, $paymentId)
    {
        $this->orderRepository->updatePaymentId($id, $paymentId);
    }
}
