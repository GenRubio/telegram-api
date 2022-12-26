<?php

namespace App\Repositories\Order;

use Carbon\Carbon;
use App\Models\Order;
use App\Repositories\Repository;

/**
 * Class OrderRepository
 * @package App\Repositories\Order
 */
class OrderRepository extends Repository implements OrderRepositoryInterface
{
    /**
     * @var int Limit for retrieve data
     */
    protected $limit;

    /**
     * @var int defaultTtl for cache
     */
    protected $defaultTtl;

    /**
     * @var order
     */
    protected $model;

    /**
     * OrderRepository constructor.
     */
    public function __construct()
    {
        $this->model = new Order();
        parent::__construct($this->model);
        $this->defaultTtl = env('CACHE_DEFAULT_TTL', 7200);
        $this->limit = 10;
    }

    public function getByReference($reference)
    {
        return $this->model->where('reference', $reference)
            ->first();
    }

    public function getByReferenceAndStatus($reference, $status)
    {
        return $this->model->where('reference', $reference)
            ->where('status', $status)
            ->first();
    }

    public function getPaymentOrder($reference, $status, $time)
    {
        return $this->model->where('reference', $reference)
            ->where('status', $status)
            ->where('created_at', '>', Carbon::now()->subMinutes($time)->format('Y-m-d H:i:s'))
            ->first();
    }

    public function createOrder($data)
    {
        return $this->model->create($data);
    }

    public function updateStatus($id, $status)
    {
        $this->model->where('id', $id)
            ->update([
                'status' => $status
            ]);
    }

    public function getForAutomaticCancel($status, $time)
    {
        return $this->model->where('status', $status)
            ->where('created_at', '<', Carbon::now()->subMinutes($time)->format('Y-m-d H:i:s'))
            ->get();
    }

    public function updateStripeId($id, $stripeId)
    {
        $this->model->where('id', $id)->update([
            'stripe_id' => $stripeId
        ]);
    }
}
