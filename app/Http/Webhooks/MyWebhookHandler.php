<?php

namespace App\Http\Webhooks;

use App\Bot\ActionShowMenu;
use App\Bot\ActionBuyProduct;
use App\Bot\ActionViewProducts;
use App\Bot\ActionViewProductDetail;
use App\Bot\ActionAddProductToTrolley;
use DefStudio\Telegraph\Handlers\WebhookHandler;

class MyWebhookHandler extends WebhookHandler
{
    use ActionAddProductToTrolley;
    use ActionBuyProduct;
    use ActionShowMenu;
    use ActionViewProductDetail;
    use ActionViewProducts;

    public function start()
    {
        $this->actionShowMenu();
    }
}
