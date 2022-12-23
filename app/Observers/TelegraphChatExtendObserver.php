<?php

namespace App\Observers;

use App\Models\Customer;
use DefStudio\Telegraph\Models\TelegraphChat;

class TelegraphChatExtendObserver
{
    /**
     * Handle the TelegraphChat "created" event.
     *
     * @param  \App\Models\TelegraphChat  $TelegraphChat
     * @return void
     */
    public function created(TelegraphChat $TelegraphChat)
    {
        $customer = Customer::create([
            'chat_id' => $TelegraphChat->chat_id
        ]);

        //Registrar usuario en Stripe
        $customer->createAsStripeCustomer();
    }

    /**
     * Handle the TelegraphChat "updated" event.
     *
     * @param  \App\Models\TelegraphChat  $TelegraphChat
     * @return void
     */
    public function updated(TelegraphChat $TelegraphChat)
    {
        //
    }

    /**
     * Handle the TelegraphChat "deleted" event.
     *
     * @param  \App\Models\TelegraphChat  $TelegraphChat
     * @return void
     */
    public function deleted(TelegraphChat $TelegraphChat)
    {
        //
    }

    /**
     * Handle the TelegraphChat "restored" event.
     *
     * @param  \App\Models\TelegraphChat  $TelegraphChat
     * @return void
     */
    public function restored(TelegraphChat $TelegraphChat)
    {
        //
    }

    /**
     * Handle the TelegraphChat "force deleted" event.
     *
     * @param  \App\Models\TelegraphChat  $TelegraphChat
     * @return void
     */
    public function forceDeleted(TelegraphChat $TelegraphChat)
    {
        //
    }
}
