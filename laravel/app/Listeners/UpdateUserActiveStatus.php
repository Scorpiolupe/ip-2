<?php

namespace App\Listeners;

use Illuminate\Auth\Events\Authenticated;
use App\Models\User;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class UpdateUserActiveStatus
{

    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    /**
     * Handle the event.
     *
     * @param  \Illuminate\Auth\Events\Authenticated  $event
     * @return void
     */
    public function handle(Authenticated $event)
    {
        // Giriş yapan kullanıcıyı al
        $user = $event->user;

        // isActive kolonunu 1 yap
        $user->isActive = 1;
    }
}
