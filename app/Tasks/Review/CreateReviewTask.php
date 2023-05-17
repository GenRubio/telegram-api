<?php

namespace App\Tasks\Review;

class CreateReviewTask
{
    private $telegraphChat;
    private $productId;
    private $rate;
    private $comment;

    public function __construct($request)
    {
        $this->telegraphChat = $request->telegraphChat;
        $this->productId = $request->productId;
        $this->rate = $request->rate;
        $this->comment = $request->comment;
    }

    public function run()
    {
        //
    }
}
