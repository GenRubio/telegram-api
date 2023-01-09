<?php

namespace App\Tasks\Geocoding;

class ValidateAddressTask
{
    private $paymentData;
    private $apiKey;

    public function __construct($request)
    {
        $this->paymentData = (object)$request->payment;
        $this->apiKey = "2873c4960bd14ab795e4f6d0f79955e9";
    }

    public function run()
    {
        $address = "{$this->paymentData->address} {$this->paymentData->postalCode} {$this->paymentData->city}";
        $apiUrl = 'https://api.opencagedata.com/geocode/v1/json?q=' . urlencode($address) . '&key=' . $this->apiKey;
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
