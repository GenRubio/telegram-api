<?php

namespace App\Providers;

use App\Models\Bot;
use App\Observers\BotObserver;
use Illuminate\Support\Facades\Event;
use Illuminate\Auth\Events\Registered;
use DefStudio\Telegraph\Models\TelegraphChat;
use App\Observers\TelegraphChatExtendObserver;
use App\Listeners\MailSuccessfulDatabaseBackup;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event to listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        \Spatie\Backup\Events\BackupZipWasCreated::class => [
            MailSuccessfulDatabaseBackup::class
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        TelegraphChat::observe(TelegraphChatExtendObserver::class);
        Bot::observe(BotObserver::class);
    }

    /**
     * Determine if events and listeners should be automatically discovered.
     *
     * @return bool
     */
    public function shouldDiscoverEvents()
    {
        return false;
    }
}
