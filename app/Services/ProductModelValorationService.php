<?php

namespace App\Services;

use App\Http\Controllers\Controller;
use App\Models\ProductModelValoration;
use App\Repositories\ProductModelValoration\ProductModelValorationRepository;
use App\Repositories\ProductModelValoration\ProductModelValorationRepositoryInterface;

/**
 * Class ProductModelValorationService
 * @package App\Services\ProductModelValoration
 */
class ProductModelValorationService extends Controller
{
    private $productModelValorationRepository;

    /**
     * ProductModelValorationService constructor.
     * @param ProductModelValoration $productModelValoration
     * @param ProductModelValorationRepositoryInterface $productModelValorationRepository
     */
    public function __construct()
    {
        $this->productModelValorationRepository = new ProductModelValorationRepository();
    }

    public function create($data)
    {
        return $this->productModelValorationRepository->create($data);
    }

    public function getChatValoration($id, $chatId)
    {
        return $this->productModelValorationRepository->getChatValoration($id, $chatId);
    }
}
