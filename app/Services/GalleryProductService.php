<?php

namespace App\Services;

use App\Http\Controllers\Controller;
use App\Models\GalleryProduct;
use App\Repositories\GalleryProduct\GalleryProductRepository;
use App\Repositories\GalleryProduct\GalleryProductRepositoryInterface;

/**
 * Class GalleryProductService
 * @package App\Services\GalleryProduct
 */
class GalleryProductService extends Controller
{
    private $galleryProductRepository;

    /**
     * GalleryProductService constructor.
     * @param GalleryProduct $GalleryProduct
     * @param GalleryProductRepositoryInterface $GalleryProductRepository
     */
    public function __construct()
    {
        $this->galleryProductRepository = new GalleryProductRepository();
    }

    public function getAll()
    {
        return $this->galleryProductRepository->getAll();
    }
}
