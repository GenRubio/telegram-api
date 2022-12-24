<?php

namespace App\Services;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Repositories\Customer\CustomerRepository;
use App\Repositories\Customer\CustomerRepositoryInterface;

/**
 * Class CustomerService
 * @package App\Services\Customer
 */
class CustomerService extends Controller
{
    private $customerRepository;

    /**
     * CustomerService constructor.
     * @param Customer $customer
     * @param CustomerRepositoryInterface $customerRepository
     */
    public function __construct()
    {
        $this->customerRepository = new CustomerRepository();
    }

    public function getByChat($chatId)
    {
        return $this->customerRepository->getByChat($chatId);
    }
}
