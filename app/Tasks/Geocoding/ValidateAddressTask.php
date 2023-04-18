<?php

namespace App\Tasks\Geocoding;

use App\Exceptions\GenericException;
use App\Services\GeocodingApiService;
use App\Tasks\API\Translations\CreateOrderErrorTextTask;

class ValidateAddressTask
{
    private $paymentData;
    private $geocodingApiService;
    private $geocoding;
    private $customer;

    public function __construct($request, $customer)
    {
        $this->customer = $customer;
        $this->paymentData = (object)$request->payment;
        $this->geocodingApiService = new GeocodingApiService();
        $this->geocoding = $this->geocodingApiService->getEnabled();
    }

    public function run()
    {
        if (is_null($this->geocoding)){
            throw new GenericException((new CreateOrderErrorTextTask($this->customer->botChat))->run());
        }
        $this->geocodingApiService->incrementRequests($this->geocoding->api_key);
        $this->geocodingApiService->incrementTotalRequests($this->geocoding->api_key);

        $address = "{$this->paymentData->address} {$this->paymentData->postal_code} {$this->paymentData->city}";
        $apiUrl = 'https://api.opencagedata.com/geocode/v1/json?q=' . urlencode($address) . '&key=' . $this->geocoding->api_key;
        $response = file_get_contents($apiUrl);
        $data = json_decode($response, true);
        if ($data['total_results'] > 0) {
            if ($data['results'][0]['components']['country'] === 'Spain') {
                return true;
            } else {
                return false;
            }
        }
        return false;
    }
}
