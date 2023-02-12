<?php

namespace App\Repositories\ProductModel;

/**
 * Interface ProductModelRepositoryInterface
 * @package App\Repositories\ProductModel
 */
interface ProductModelRepositoryInterface
{
    public function enabled($id);
    public function getByReferences($references);
    public function getByReference($reference);
    public function getAllActive();
    public function get($filter);
}
