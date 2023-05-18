<?php

namespace App\Tasks\Valoration;

use Carbon\Carbon;
use App\Exceptions\GenericException;
use App\Services\ProductModelService;
use App\Services\ProductModelValorationService;

class CreateValorationTask
{
    private $telegraphChat;
    private $productReference;
    private $rate;
    private $comment;
    private $productModel;
    private $userValoration;

    public function __construct($telegraphChat, $request)
    {
        $this->telegraphChat = $telegraphChat;
        $this->productReference = $request->productReference;
        $this->rate = $request->rate;
        $this->comment = $request->comment;
        $this->productModel = (new ProductModelService())->getByReference($this->productReference);
        $this->userValoration = (new ProductModelValorationService())
            ->getChatValoration($this->productModel->id, $this->telegraphChat->chat_id);
    }

    public function run()
    {
        if (is_null($this->productModel)) {
            throw new GenericException("Product not found");
        }
        if (!is_null($this->userValoration)) {
            throw new GenericException("You already rated this product");
        }

        $data = $this->prepareData();
        (new ProductModelValorationService())->create($data);

        return [
            'stars' => $data['stars'],
            'comment' => $data['comment'],
            'likes' => $data['likes'],
            'dislikes' => $data['dislikes'],
            'visible' => $data['visible'],
            'user_valoration' => true,
            'created_at' => Carbon::parse($data['created_at'])->format('d/m/Y'),
        ];
    }

    private function prepareData()
    {
        return [
            'chat_id' => $this->telegraphChat->chat_id,
            'product_model_id' => $this->productModel->id,
            'stars' => $this->rate,
            'comment' => $this->comment,
            'likes' => 0,
            'dislikes' => 0,
            'visible' => true,
            'created_at' => Carbon::now(),
        ];
    }
}
