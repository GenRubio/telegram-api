<?php

namespace App\Repositories\Affiliate;

/**
 * Interface AffiliateRepositoryInterface
 * @package App\Repositories\Affiliate
 */
interface AffiliateRepositoryInterface
{
    public function getByReference($reference);
}
