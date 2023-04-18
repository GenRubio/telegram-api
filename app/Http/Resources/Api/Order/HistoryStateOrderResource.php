<?php

namespace App\Http\Resources\Api\Order;

use Carbon\Carbon;
use App\Enums\OrderStatusEnum;
use App\Tasks\API\Translations\GenericTextTask;
use Illuminate\Http\Resources\Json\JsonResource;

class HistoryStateOrderResource extends JsonResource
{
    private $states;
    private $telegraphChat;

    public function __construct($states, $telegraphChat)
    {
        $this->states = $states;
        $this->telegraphChat = $telegraphChat;
    }

    public function toArray($request)
    {
        $response = [];
        foreach ($this->states as $state) {
            if (isset(OrderStatusEnum::STATUS_WEB[$state->state])) {
                $response[] = [
                    'state' => $state->state,
                    'data' => OrderStatusEnum::STATUS_WEB[$state->state],
                    'text' => (new GenericTextTask($this->telegraphChat, OrderStatusEnum::STATUS_WEB[$state->state]['trans_id']))->run(),
                    'created_at' => Carbon::parse($state->created_at)->format('d-m-Y H:i:s')
                ];
            }
        }
        return $response;
    }
}
