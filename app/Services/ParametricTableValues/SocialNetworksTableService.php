<?php

namespace App\Services\ParametricTableValues;

use App\Http\Controllers\Controller;
use App\Models\ParametricTableValues\SocialNetworksTable;
use App\Repositories\ParametricTableValue\SocialNetworksTable\SocialNetworksTableRepository;
use App\Repositories\ParametricTableValue\SocialNetworksTable\SocialNetworksTableRepositoryInterface;
use App\Services\ParametricTableValueService;

/**
 * Class SocialNetworksTableService
 * @package App\Services\ParametricTableValues\SocialNetworksTableService
 */
class SocialNetworksTableService extends ParametricTableValueService
{
    private $socialNetworksTableRepository;

    /**
     * SocialNetworksTableService constructor.
     * @param SocialNetworksTable $socialNetworksTable
     * @param SocialNetworksTableRepositoryInterface $socialNetworksTableRepository
     */
    public function __construct()
    {
        parent::__construct();
        $this->socialNetworksTableRepository = new SocialNetworksTableRepository();
    }

    /**
     * Entry
     */
    public function handle()
    {
        //
    }

}
