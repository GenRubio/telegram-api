<?php

namespace App\Http\Webhooks;

use App\Bot\ActionShowMenu;
use App\Bot\ActionBuyProduct;
use App\Bot\ActionViewProducts;
use App\Bot\ActionShowMyTrolley;
use App\Bot\ActionMyTrolleyManager;
use App\Bot\ActionViewProductDetail;
use App\Bot\ActionAddProductToTrolley;
use App\Bot\ActionDeleteMyTrolleyProduct;
use DefStudio\Telegraph\Handlers\WebhookHandler;

class MyWebhookHandler extends WebhookHandler
{
    use ActionAddProductToTrolley;
    use ActionBuyProduct;
    use ActionShowMenu;
    use ActionViewProductDetail;
    use ActionViewProducts;
    use ActionShowMyTrolley;
    use ActionMyTrolleyManager;
    use ActionDeleteMyTrolleyProduct;

    public function start()
    {
        $this->actionShowMenu();
    }

    public function menu()
    {
        $this->actionShowMenu();
    }
}
