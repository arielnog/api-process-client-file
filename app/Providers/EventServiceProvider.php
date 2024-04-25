<?php

namespace App\Providers;

use App\Events\ProcessFile\Contracts\IProcessFileEvent;
use App\Events\ProcessFile\Contracts\ISendEmailBillingSlipEvent;
use App\Events\ProcessFile\ProcessFileEvent;
use App\Events\ProcessFile\SendEmailBillingSlipEvent;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event to listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        IProcessFileEvent::EVENT_NAME => [
            ProcessFileEvent::class
        ],

        ISendEmailBillingSlipEvent::EVENT_NAME => [
            SendEmailBillingSlipEvent::class
        ]
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        //
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
