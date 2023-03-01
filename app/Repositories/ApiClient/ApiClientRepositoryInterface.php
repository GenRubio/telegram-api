<?php

namespace App\Repositories\ApiClient;

/**
 * Interface ApiClientRepositoryInterface
 * @package App\Repositories\ApiClient
 */
interface ApiClientRepositoryInterface
{
    public function getAll();
    public function getToPing();
    public function setOnline($id, $status);
    public function getOnline();
    public function getByDomain($domain);
}
