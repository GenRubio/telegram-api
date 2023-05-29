<?php

namespace App\Http\Resources\Api\ProductDetail;

use App\Models\Order;
use App\Enums\OrderStatusEnum;
use App\Services\TranslationService;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Api\ProductGalleryResource;

class ProductProductDetailResource extends JsonResource
{
    private $product;
    private $telegraphChat;
    private $language;
    private $translationService;
    private $translations;

    public function __construct($product, $telegraphChat, $language)
    {
        $this->product = $product;
        $this->telegraphChat = $telegraphChat;
        $this->language = $language;
        $this->translationService = new TranslationService();
        $this->translations = $this->translationService->getAll();
    }

    public function toArray($request)
    {
        return [
            'reference' => $this->product->reference,
            'name' => $this->product->name,
            'image' => url($this->product->image),
            'price' => $this->product->price,
            'discount' => $this->product->discount,
            'price_with_discount' => $this->product->price_with_discount,
            'brand' => $this->product->productBrand->name,
            'product_description' => json_decode($this->product->description)[$this->language],
            'multiple_flavors' => $this->product->multiple_flavors,
            'flavors' => count($this->product->productModelsFlavors),
            'shopping' => $this->getTotalProductsBuyed(),
            'gallery' => json_decode(json_encode(new ProductGalleryResource($this->product->galleryImages))),
            'valoration_mean' => $this->getValorationsMean(),
            'user' => [
                'bought' => $bought = $this->isProductBought(),
                'has_valoration' => $bought ? $this->hasValorationFromUser() : false,
            ],
            'description' => [
                'data' => [
                    [
                        'name' => $this->getTranslationByUuid('1fed3baa-9373-4786-8848-802873f05f0f'),
                        'value' => $this->product->concentration,
                        'simbol' => 'mg/ml',
                        'image' => url('images/icons/bg3-1.png'),
                        'has_images' => true
                    ],
                    [
                        'name' => $this->getTranslationByUuid('d5bc98d7-e85a-4ebd-a3d6-986c1039c1fc'),
                        'value' => $this->product->absorbable_quantity,
                        'simbol' => 'Puffs',
                        'image' => url('images/icons/bg3-2.png'),
                        'has_images' => true
                    ],
                    [
                        'name' => $this->getTranslationByUuid('4537c769-5134-4217-abae-deb16f3cd8dc'),
                        'value' => $this->product->size,
                        'simbol' => 'mm',
                        'has_images' => false
                    ],
                    [
                        'name' => $this->getTranslationByUuid('d77fa6c3-a544-4737-b10d-1a7197c9ebb3'),
                        'value' => $this->product->power_range,
                        'simbol' => 'W',
                        'has_images' => false
                    ],
                    [
                        'name' => $this->getTranslationByUuid('bec3b5f9-2945-445a-a3f6-4967ec4a1072'),
                        'value' => $this->product->battery_capacity,
                        'simbol' => 'mAh',
                        'image' => url('images/icons/bg3-4.png'),
                        'has_images' => true
                    ],
                    [
                        'name' => $this->getTranslationByUuid('c92e37ac-2b3e-4922-bc18-de4e10332042'),
                        'value' => $this->product->e_liquid_capacity,
                        'simbol' => 'ml',
                        'image' => url('images/icons/bg3-5.png'),
                        'has_images' => true
                    ],
                    [
                        'name' => $this->getTranslationByUuid('4af39b37-12b1-4e33-b383-6900f342f90a'),
                        'value' => $this->product->resistance,
                        'simbol' => 'Ω',
                        'image' => url('images/icons/bg3-6.png'),
                        'has_images' => true
                    ],
                    [
                        'name' => $this->getTranslationByUuid('4644d1de-43fc-4cc5-98a5-21b0cbdc8481'),
                        'value' => $this->product->charging_port,
                        'simbol' => null,
                        'image' => url('images/icons/bg3-3.png'),
                        'has_images' => true
                    ]
                ]
            ]
        ];
    }

    private function getValorationsMean()
    {
        $visibleValorations = $this->product->valorations()->where('visible', true)->get();
        if ($visibleValorations->count() == 0) {
            return 5;
        }
        $stars = 0;
        foreach ($visibleValorations as $valoration) {
            $stars += $valoration->stars;
        }
        $resum = $stars / $visibleValorations->count();
        return round($resum, 1);
    }

    private function getTranslationByUuid($uuid)
    {
        $translation = $this->translations->where('uuid', $uuid)->first();
        return $translation->langText($this->language);
    }

    private function getTotalProductsBuyed()
    {
        $orders = Order::whereNotIn('status', [
            OrderStatusEnum::STATUS_IDS['cancel'],
            OrderStatusEnum::STATUS_IDS['pd_payment'],
            OrderStatusEnum::STATUS_IDS['error'],
            OrderStatusEnum::STATUS_IDS['payment_accepted'],
            OrderStatusEnum::STATUS_IDS['payment_denied'],
        ])->get();

        $orderProducts = $orders->map(function ($order) {
            return $order->orderProducts->where('product_model_id', $this->product->id);
        })->flatten();

        return $orderProducts->sum('amount');
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

    private function hasValorationFromUser()
    {
        return $this->product->valorations->where('chat_id', $this->telegraphChat->chat_id)
            ->where('product_model_id', $this->product->id)
            ->first() ? true : false;
    }
}
