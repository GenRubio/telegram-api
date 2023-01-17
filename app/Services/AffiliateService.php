<?php

namespace App\Services;

use App\Http\Controllers\Controller;
use App\Models\Affiliate;
use App\Repositories\Affiliate\AffiliateRepository;
use App\Repositories\Affiliate\AffiliateRepositoryInterface;

/**
 * Class AffiliateService
 * @package App\Services\Affiliate
 */
class AffiliateService extends Controller
{
    private $affiliateRepository;

    /**
     * AffiliateService constructor.
     * @param Affiliate $affiliate
     * @param AffiliateRepositoryInterface $affiliateRepository
     */
    public function __construct()
    {
        $this->affiliateRepository = new AffiliateRepository();
    }

    public function getByReference($reference)
    {
        return $this->affiliateRepository->getByReference($reference);
    }
}
