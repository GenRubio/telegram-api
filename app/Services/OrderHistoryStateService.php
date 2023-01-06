<?php

namespace App\Services;

use App\Http\Controllers\Controller;
use App\Models\OrderHistoryState;
use App\Repositories\OrderHistoryState\OrderHistoryStateRepository;
use App\Repositories\OrderHistoryState\OrderHistoryStateRepositoryInterface;

/**
 * Class OrderHistoryStateService
 * @package App\Services\OrderHistoryState
 */
class OrderHistoryStateService extends Controller
{
    private $orderhistorystateRepository;

    /**
     * OrderHistoryStateService constructor.
     * @param OrderHistoryState $orderhistorystate
     * @param OrderHistoryStateRepositoryInterface $orderhistorystateRepository
     */
    public function __construct()
    {
        $this->orderhistorystateRepository = new OrderHistoryStateRepository();
    }

    public function create($data)
    {
        $this->orderhistorystateRepository->create($data);
    }
}
