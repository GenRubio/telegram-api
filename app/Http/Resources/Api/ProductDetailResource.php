<?php

namespace App\Http\Resources\Api;

use App\Models\Order;
use App\Enums\OrderStatusEnum;
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
                    'multiple_flavors' => $flavor->productModel->multiple_flavors,
                ],
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
            'multiple_flavors' => $product->multiple_flavors,
            'flavors' => count($product->productModelsFlavors),
            'shopping' => $this->getTotalProductsBuyed($product),
            'gallery' => json_decode(json_encode(new ProductGalleryResource($product->galleryImages))),
            'bought' => $bought = $this->isProductBought(),
            'has_valoration' => $bought ? $this->hasValorationFromUser() : false,
            'description' => [
                'data' => [
                    [
                        'name' => $this->getTranslationByUuid('1fed3baa-9373-4786-8848-802873f05f0f'),
                        'value' => $product->concentration,
                        'simbol' => 'mg/ml',
                        'image' => url('images/icons/bg3-1.png'),
                        'has_images' => true
                    ],
                    [
                        'name' => $this->getTranslationByUuid('d5bc98d7-e85a-4ebd-a3d6-986c1039c1fc'),
                        'value' => $product->absorbable_quantity,
                        'simbol' => 'Puffs',
                        'image' => url('images/icons/bg3-2.png'),
                        'has_images' => true
                    ],
                    [
                        'name' => $this->getTranslationByUuid('4537c769-5134-4217-abae-deb16f3cd8dc'),
                        'value' => $product->size,
                        'simbol' => 'mm',
                        'has_images' => false
                    ],
                    [
                        'name' => $this->getTranslationByUuid('d77fa6c3-a544-4737-b10d-1a7197c9ebb3'),
                        'value' => $product->power_range,
                        'simbol' => 'W',
                        'has_images' => false
                    ],
                    [
                        'name' => $this->getTranslationByUuid('bec3b5f9-2945-445a-a3f6-4967ec4a1072'),
                        'value' => $product->battery_capacity,
                        'simbol' => 'mAh',
                        'image' => url('images/icons/bg3-4.png'),
                        'has_images' => true
                    ],
                    [
                        'name' => $this->getTranslationByUuid('c92e37ac-2b3e-4922-bc18-de4e10332042'),
                        'value' => $product->e_liquid_capacity,
                        'simbol' => 'ml',
                        'image' => url('images/icons/bg3-5.png'),
                        'has_images' => true
                    ],
                    [
                        'name' => $this->getTranslationByUuid('4af39b37-12b1-4e33-b383-6900f342f90a'),
                        'value' => $product->resistance,
                        'simbol' => 'Ω',
                        'image' => url('images/icons/bg3-6.png'),
                        'has_images' => true
                    ],
                    [
                        'name' => $this->getTranslationByUuid('4644d1de-43fc-4cc5-98a5-21b0cbdc8481'),
                        'value' => $product->charging_port,
                        'simbol' => null,
                        'image' => url('images/icons/bg3-3.png'),
                        'has_images' => true
                    ]
                ]
            ]
        ];
    }

    private function hasValorationFromUser()
    {
        return $this->product->valorations->where('user_id', auth()->user()->id)
            ->where('product_model_id', $this->product->id)
            ->first() ? true : false;
    }

    private function isProductBought(): bool
    {
        $orders = Order::whereNotIn('status', [
            OrderStatusEnum::STATUS_IDS['cancel'],
            OrderStatusEnum::STATUS_IDS['pd_payment'],
            OrderStatusEnum::STATUS_IDS['error'],
            OrderStatusEnum::STATUS_IDS['payment_accepted'],
            OrderStatusEnum::STATUS_IDS['payment_denied'],
        ])->get();

        $orderProducts = $orders->map(function ($order) {
            return $order->orderProducts;
        })->flatten();

        return $orderProducts->where('product_model_id', $this->product->id)->count() > 0;
    }

    private function getTranslationByUuid($uuid)
    {
        $translation = $this->translations->where('uuid', $uuid)->first();
        return $translation->langText($this->language);
    }

    private function getTotalProductsBuyed($product)
    {
        $orders = Order::whereNotIn('status', [
            OrderStatusEnum::STATUS_IDS['cancel'],
            OrderStatusEnum::STATUS_IDS['pd_payment'],
            OrderStatusEnum::STATUS_IDS['error'],
            OrderStatusEnum::STATUS_IDS['payment_accepted'],
            OrderStatusEnum::STATUS_IDS['payment_denied'],
        ])->get();

        $orderProducts = $orders->map(function ($order) use ($product) {
            return $order->orderProducts->where('product_model_id', $product->id);
        })->flatten();

        return $orderProducts->sum('amount');
    }
}
