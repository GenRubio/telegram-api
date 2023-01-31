<?php

namespace App\Http\Resources\Api;

use App\Services\TranslationService;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductDetailResource extends JsonResource
{
    private $product;
    private $chat;
    private $language;
    private $translationService;
    private $translations;

    public function __construct($product, $chat)
    {
        $this->product = $product;
        $this->chat = $chat;
        $this->language = $this->chat->language->abbr;
        $this->translationService = new TranslationService();
        $this->translations = $this->translationService->getAll();
    }

    public function toArray($request)
    {
        $response = [];
        $response['product'] = $this->getProductData($this->product);
        $response['flavors'] = $this->getFlavorsData($this->product);
        $response['valorations'] = $this->getValorationsData($this->product);
        return $response;
    }

    private function getValorationsData($product)
    {
        $response = [];
        foreach ($product->valorations as $valoration) {
            $response[] = [
                'stars' => $valoration->stars,
                'comment' => $valoration->comment,
                'likes' => $valoration->likes,
                'dislikes' => $valoration->dislikes,
                'created_at' => $valoration->created_at,
            ];
        }
        return $response;
    }

    private function getFlavorsData($product)
    {
        $response = [];
        foreach ($product->productModelsFlavors as $flavor) {
            $response[] = [
                'reference' => $flavor->reference,
                'name' => $flavor->name,
                'image' => url($flavor->image),
                'stock' => $flavor->stock - $flavor->stock_bloqued,
                'product_model' => [
                    'reference' => $flavor->productModel->reference,
                    'name' => $flavor->productModel->name,
                    'image' => url($flavor->productModel->image),
                    'price' => $flavor->productModel->price,
                    'discount' => $flavor->productModel->discount,
                    'price_with_discount' => $flavor->productModel->price_with_discount,
                    'brand' => $flavor->productModel->productBrand->name,
                ]
            ];
        }
        return $response;
    }

    private function getProductData($product)
    {
        return [
            'reference' => $product->reference,
            'name' => $product->name,
            'image' => url($product->image),
            'price' => $product->price,
            'discount' => $product->discount,
            'price_with_discount' => $product->price_with_discount,
            'brand' => $product->productBrand->name,
            'flavors' => count($product->productModelsFlavors),
            'description' => [
                'data' => [
                    [
                        'name' => $this->getTranslationByUuid('1671777986.996363a54ec2f33a9'),
                        'value' => $product->concentration,
                        'simbol' => 'mg/ml',
                        'image' => url('images/icons/bg3-1.png'),
                        'has_images' => true
                    ],
                    [
                        'name' => $this->getTranslationByUuid('1671778008.413463a54ed864ef9'),
                        'value' => $product->absorbable_quantity,
                        'simbol' => 'Puffs',
                        'image' => url('images/icons/bg3-2.png'),
                        'has_images' => true
                    ],
                    [
                        'name' => $this->getTranslationByUuid('1671778015.547363a54edf859bd'),
                        'value' => $product->size,
                        'simbol' => 'mm',
                        'has_images' => false
                    ],
                    [
                        'name' => $this->getTranslationByUuid('1671778023.580863a54ee78dca6'),
                        'value' => $product->power_range,
                        'simbol' => 'W',
                        'has_images' => false
                    ],
                    [
                        'name' => $this->getTranslationByUuid('1671778039.236463a54ef739b80'),
                        'value' => $product->battery_capacity,
                        'simbol' => 'mAh',
                        'image' => url('images/icons/bg3-4.png'),
                        'has_images' => true
                    ],
                    [
                        'name' => $this->getTranslationByUuid('1671778050.365463a54f025935e'),
                        'value' => $product->e_liquid_capacity,
                        'simbol' => 'ml',
                        'image' => url('images/icons/bg3-5.png'),
                        'has_images' => true
                    ],
                    [
                        'name' => $this->getTranslationByUuid('1671778059.778763a54f0bbe1a1'),
                        'value' => $product->resistance,
                        'simbol' => 'Ω',
                        'image' => url('images/icons/bg3-6.png'),
                        'has_images' => true
                    ],
                    [
                        'name' => $this->getTranslationByUuid('1671778073.652763a54f199f58d'),
                        'value' => $product->charging_port,
                        'simbol' => null,
                        'image' => url('images/icons/bg3-3.png'),
                        'has_images' => true
                    ]
                ]
            ]
        ];
    }

    private function getTranslationByUuid($uuid)
    {
        $translation = $this->translations->where('uuid', $uuid)->first();
        return $translation->langText($this->language);
    }
}
