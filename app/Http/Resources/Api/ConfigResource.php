<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Api\Config\BrandsConfigResource;
use App\Http\Resources\Api\Config\SettingsConfigResource;
use App\Http\Resources\Api\Config\TranslationsConfigResource;
use App\Http\Resources\Api\Config\ParametricTablesConfigResource;

class ConfigResource extends JsonResource
{
    private $telegraphChat;
    private $language;

    public function __construct($telegraphChat)
    {
        $this->telegraphChat = $telegraphChat;
        $this->language = $this->telegraphChat->language->abbr;
    }

    public function toArray($request)
    {
        $response = [];
        $response['translations'] = json_decode(json_encode(new TranslationsConfigResource($this->language)));
        $response['settings'] = json_decode(json_encode(new SettingsConfigResource()));
        $response['brands'] = json_decode(json_encode(new BrandsConfigResource()));
        $response['parametric_tables'] = json_decode(json_encode(new ParametricTablesConfigResource()));
        return $response;
    }
}
