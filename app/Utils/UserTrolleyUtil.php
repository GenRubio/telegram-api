<?php

namespace App\Utils;

use Illuminate\Support\Facades\Storage;

class UserTrolleyUtil
{
    public static function countProducts($chatId)
    {
        $disk = Storage::disk('users_trolley');
        $fileName = "{$chatId}.json";
        if ($disk->exists($fileName)) {
            $data = json_decode($disk->get($fileName));
            return count($data->products);
        }
        return 0;
    }

    public static function productInTrolley($chatId, $productReference)
    {
        $disk = Storage::disk('users_trolley');
        $fileName = "{$chatId}.json";
        if ($disk->exists($fileName)) {
            $data = json_decode($disk->get($fileName));
            if (in_array($productReference, $data->products)) {
                return true;
            }
        }
        return false;
    }

    public static function getProducts($chatId)
    {
        $disk = Storage::disk('users_trolley');
        $fileName = "{$chatId}.json";
        if ($disk->exists($fileName)) {
            $data = json_decode($disk->get($fileName));
            return $data->products;
        }
        return [];
    }
}
