<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Auth\Events\Authenticated;

class EventServiceProvider extends ServiceProvider
{
    protected $listen = [
        Authenticated::class => [
            'App\Listeners\UpdateUserActiveStatus',
        ],
    ];

    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
